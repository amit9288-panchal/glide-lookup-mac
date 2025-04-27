<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RegisterMacResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        $response = [];
        foreach ($this->resource as $macList) {
            $response[] = [
                'mac_address' => $macList->mac_address,
                'vendor' => $macList->organization_name,
            ];
        }
        return $response;
    }
}
