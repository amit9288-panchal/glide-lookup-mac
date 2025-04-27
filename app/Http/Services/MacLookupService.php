<?php

namespace App\Http\Services;

use App\Models\OUI;
use Illuminate\Database\Eloquent\Collection;

class MacLookupService
{
    public function getRegisterForSingleMac(string $mac): Collection|array
    {
        $registerCollection = OUI::where('assignment', getMacPrefix($mac))->get();
        if ($registerCollection->isEmpty()) {
            return [];
        }
        return $registerCollection->map(function ($registry) use ($mac) {
            $registry['mac_address'] = $mac;
            return $registry;
        });
    }

    public function getRegisterForMultipleMac(array $macList): Collection|array
    {
        $registerCollection = OUI::whereIn('assignment', getBulkMacPrefix($macList))->get();
        if ($registerCollection->isEmpty()) {
            return [];
        }
        return $registerCollection->map(function ($registry) use ($macList) {
            // Find the exact MAC address from the list that matches this registry's assignment
            $matchedMac = collect($macList)->first(function ($mac) use ($registry) {
                return getMacPrefix($mac) === $registry->assignment;
            });

            $registry['mac_address'] = $matchedMac;
            return $registry;
        });
    }
}
