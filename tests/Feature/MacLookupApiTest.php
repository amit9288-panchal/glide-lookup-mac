<?php

namespace Tests\Feature;

use Tests\TestCase;

class MacLookupApiTest extends TestCase
{
    public function test_it_returns_mac_address_vendor_data()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => '7O7BbxTYZLyp01Sp8K2xTEQ24fjp7kS6qoG8yY1F1Fk',
        ])->getJson('/api/v1/mac-lookup/2015821A0E60');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    [
                        'mac_address' => '2015821A0E60',
                        'vendor' => 'Apple, Inc.',
                    ],
                ]
            ]);
    }

    public function test_it_returns_vendor_data_for_bulk_mac_addresses()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => '7O7BbxTYZLyp01Sp8K2xTEQ24fjp7kS6qoG8yY1F1Fk',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/mac-lookup/list', [
            'MACAddressList' => [
                '2015821A0E60'
            ]
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    [
                        'mac_address' => '2015821A0E60',
                        'vendor' => 'Apple, Inc.',
                    ]
                ]
            ]);
    }

    public function test_it_returns_unauthorized_for_missing_api_key()
    {
        $response = $this->getJson('/api/v1/mac-lookup/2015821A0E60');
        $response->assertStatus(401);
    }

    public function test_it_returns_404_for_nonexistent_mac_address()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => '7O7BbxTYZLyp01Sp8K2xTEQ24fjp7kS6qoG8yY1F1Fk',
        ])->getJson('/api/v1/mac-lookup/999999999999');
        $response->assertStatus(404);
    }

}
