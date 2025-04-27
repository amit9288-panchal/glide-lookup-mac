<?php

namespace Tests\Feature\Console\Commands;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ImportOUITest extends TestCase
{
    public function test_it_imports_oui_data_successfully()
    {
        Http::fake([
            'http://standards-oui.ieee.org/oui/oui.csv' => Http::response(
                <<<CSV
Registry,Assignment,Organization Name,Organization Address
MA-L,201582,"Apple, Inc.","1 Infinite Loop Cupertino CA US 95014"
CSV,
                200
            ),
        ]);

        $this->artisan('app:importOUI')
            ->assertExitCode(0);

        $this->assertDatabaseHas('ouis', [
            'assignment' => '201582',
            'organization_name' => 'Apple, Inc.',
        ]);

        $this->assertDatabaseHas('ouis', [
            'assignment' => '201582',
            'organization_name' => 'Apple, Inc.',
        ]);
    }
}
