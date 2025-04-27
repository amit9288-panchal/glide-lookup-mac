<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\OUI;
use Throwable;


/**
 * Import command for Organizational Unique Identifier
 */
class ImportOUI extends Command
{
    private const OUI_URL = 'http://standards-oui.ieee.org/oui/oui.csv';
    protected $signature = 'app:importOUI';
    protected $description = 'This command imports the latest IEEE Organizational Unique Identifier (OUI) data into the database';

    public function handle(): void
    {
        try {
            Log::info('Start importing...');
            $csv = Http::get(self::OUI_URL)->body();

            $lines = array_map('str_getcsv', explode("\n", $csv));
            foreach ($lines as $i => $line) {
                /** excluding heading */
                if ($i === 0 || count($line) < 3) {
                    continue;
                }

                $macAddress = strtoupper(str_replace([':', '-', '.'], '', substr($line[1], 0, 20)));
                $search = ['assignment' => $macAddress];
                $insertOrUpdate = [
                    'registry' => strtoupper(trim($line[0])),
                    'assignment' => $macAddress,
                    'organization_name' => trim($line[2]),
                    'organization_address' => trim($line[3]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OUI::updateOrInsert($search, $insertOrUpdate);
            }
            Log::info('End importing...');
        } catch (Throwable $e) {
            Log::error('OUI import error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }
    }
}
