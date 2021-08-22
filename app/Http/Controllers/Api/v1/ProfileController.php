<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\FormUnderConsideration;
use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editProfile = Profiles::where("status_profile", "=", "unconsidered");
        $amount = $editProfile->count();
        $data = $editProfile->first();

        return response()->json([
            "status" => true,
            "data" => $data,
            "amount" => $amount
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"],
                "age" => ["required"],
                "email" => ["required"],
                "birth_data" => ["required"],
                "phone" => ["required"],
                "picture" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 422);
        }

        $data = [
            "name" => $request->name,
            "age" => $request->age,
            "email" => $request->email,
            "birth_data" => $request->birth_data,
            "phone" => $request->phone,
            "picture" => $request->picture,
        ];

        try {
            $profile = Profiles::create($data);
        } catch (\Exception $exception) {
            Log::info("Ошибка при добавлении профиля в базу данных" . json_encode($data));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Error create Profile"
            ], 500);
        }

        return response()->json([
            "status" => true,
            "profile" => $profile
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $profile = Profiles::where("id", "=", $id)->first();
        } catch (\Exception $exception) {
            Log::info("Ошибка при поиске профиля по id:" . json_encode($id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Profile not found"
            ], 404);
        }

        return $profile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $profile = Profiles::where("id", "=", $id)->first();
            $profile->status_profile = $request->status_profile;
            $profile->save();
        } catch (\Exception $exception) {
            Log::info("Ошибка при изменении статуса профиля по id:" . json_encode($id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Profile not edit"
            ], 404);
        }

        return response()->json([
            "status" => true,
            "message" => "edit completed successfully"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
