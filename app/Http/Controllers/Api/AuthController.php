<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Google2FA;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]
        );

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->messages()
            ], 422);
        }

        $google2fa = app('pragmarx.google2fa');
        $data = [
            "name"  =>$request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "google2fa_secret" => $google2fa->generateSecretKey()
        ];


        try {
            $user = User::create($data);
        } catch (\Exception $exception) {
            Log::info("Ошибка при добавлении менеджера в базу данных" . json_encode($data));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Error register",
            ],500);
        }

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user['email'],
            $user['google2fa_secret']
        );

        return response()->json([
            "status" => true,
            "user" => $user,
            "QR" => $QR_Image,
            "g2fa" => $user['google2fa_secret'],
        ], 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to login'
            ],401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ],200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ],200);
    }

    public function guard()
    {
        return Auth::Guard('api');
    }

    public function checkToken()
    {
        return response()->json(['success' => true], 200);
    }


}
