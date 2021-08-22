<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Google2FA;

class Google2FAController extends Controller
{

    /**
     * Login Google 2fa
     * @param int id
     * @param string code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function enable2fa(Request $request)
    {
        try {
            // Поиск менеджера по id
            $user = User::find($request->id);
        } catch (\Exception $exception) {
            Log::info("Ошибка при поиске менеджера с id: " . json_encode($request->id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Error: not found",
            ], 404);
        }

        $valid = Google2FA::verifyKey($user->google2fa_secret, strval($request->code));
        if ($valid) {
            return response()->json([
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'status' => false
            ], 200);
        }
    }
}
