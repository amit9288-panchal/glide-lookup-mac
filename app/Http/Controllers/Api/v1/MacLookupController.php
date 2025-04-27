<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\MacLookupService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\RegisterMacResource;
use Exception;

class MacLookupController extends Controller
{
    private MacLookupService $macLookupService;

    public function __construct(
        MacLookupService $macLookupService
    ) {
        $this->macLookupService = $macLookupService;
    }

    public function lookup(Request $request, string $mac): JsonResponse
    {
        try {
            $MACInfo = $this->macLookupService->getRegisterForSingleMac($mac);
            if (!$MACInfo) {
                return $this->notFoundResponse();
            }
            return $this->successResponse(
                (new RegisterMacResource($MACInfo))
            );
        } catch (Exception $e) {
            return $this->errorResponse([],
                $e->getMessage(),
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function lookupList(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'MACAddressList' => ['required', 'array'],
                'MACAddressList.*' => ['required', 'string', 'regex:/^([0-9A-Fa-f]{2}[:-]?){5}([0-9A-Fa-f]{2})$/'],
            ], [
                'MACAddressList.required' => 'You must provide a list of MAC addresses.',
                'MACAddressList.array' => 'The MACAddressList must be an array.',
                'MACAddressList.*.required' => 'Each MAC address is required.',
                'MACAddressList.*.string' => 'Each MAC address must be a string.',
                'MACAddressList.*.regex' => 'Each MAC address must be in a valid format (e.g., 5C:E9:1E:8F:8C:72, 5C-E9-1E-8F-8C-72, 5CE91E8F8C72).',
            ]);
            $macAddresses = $validated['MACAddressList'];
            $MACInfo = $this->macLookupService->getRegisterForMultipleMac($macAddresses);
            if (!$MACInfo) {
                return $this->notFoundResponse();
            }
            return $this->successResponse(
                (new RegisterMacResource($MACInfo))
            );
        } catch (Exception $e) {
            return $this->errorResponse([],
                $e->getMessage(),
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
