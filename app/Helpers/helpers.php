<?php

if (!function_exists('getMacPrefix')) {
    function getMacPrefix(string $macAddress): ?string
    {
        $mac = preg_replace('/[^A-Fa-f0-9]/', '', $macAddress);

        return $mac ? strtoupper(substr($mac, 0, 6)) : null;
    }
}
if (!function_exists('getBulkMacPrefix')) {
    function getBulkMacPrefix(array $macAddressList): array
    {
        $macPrefixList = [];
        foreach ($macAddressList as $macAddress) {
            $macPrefixList[] = getMacPrefix($macAddress);
        }
        return $macPrefixList;
    }
}
