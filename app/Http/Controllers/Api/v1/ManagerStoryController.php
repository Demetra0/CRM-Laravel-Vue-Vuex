<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ManagerStory;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Validator;

class ManagerStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Количество профилей в истории
    public function index()
    {
        return ManagerStory::count();
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
    // Добавить профиль в историю менеджера
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                "id" => ["required"],
                "profile_id" => ["required", "unique:manager_stories"],
                "status_profile" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 422);
        }

        try {
            // Поиск менеджера по id
            $id = $request->id;
            $user = User::find($id);
        } catch (\Exception $exception) {
            Log::info("Ошибка при поиске менеджера с id: " . json_encode($id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Error register",
            ], 201);
        }

        try {
            $profile = new ManagerStory();
            $profile->profile_id = $request->profile_id;
            $profile->status_profile = $request->status_profile;

            $user->history()->save($profile);
        } catch (\Exception $exception) {
            Log::info("Ошибка при добавлении истории менеджера в базу данных" . json_encode($request->profile_id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());
            return response()->json([
                "status" => false,
                "message" => "Error create ManagerStory"
            ], 500);
        }

        return response()->json([
            "status" => true,
            "message" => "insert completed successfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    // Показать историю менеджера
    public function show($id)
    {
        try {
            // Поиск менеджера по id
            $user = User::find($id);
        } catch (\Exception $exception) {
            Log::info("Ошибка при поиске менеджера с id: " . json_encode($id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Error: not found",
            ], 404);
        }
        // Получаем все анкеты из истории менеджера
        $Profiles = $user->history()->get();
        try {
            // Формируется массив, в котором будут храниться данные о рассмотренных анкетах менеджером
            $data = array();
            foreach ($Profiles as $value) {
                $data[] = Profiles::where("id", "=", $value->profile_id)->first();
            }
        } catch (\Exception $exception) {
            Log::info("Ошибка при получении данных профилей с бд " . json_encode($value->profile_id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => $exception
            ], 404);
        }

        return response()->json([
            "status" => true,
            "profiles" => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    // Изменить статус профиля
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
            // Поиск менеджера по id
            $user = User::find($id);
        } catch (\Exception $exception) {
            Log::info("Ошибка при поиске менеджера с id: " . json_encode($id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Error: not found",
            ], 404);
        }
        $status_profile = $request->status_profile;
        $profile_id = $request->profile_id;
        try {
            // Поиск profile_id
            $editProfile = $user->history()->where("profile_id", "=", $profile_id)->first();
            // Изменяется статус анкеты в истории менеджера
            $editProfile->status_profile = $status_profile;
            $editProfile->save();
        } catch (\Exception $exception) {
            Log::info("Ошибка при смене статуса профиля: " . json_encode($profile_id));
            Log::error($exception->getMessage());
            Log::error($exception->getFile());
            Log::error($exception->getTraceAsString());

            return response()->json([
                "status" => false,
                "message" => "Not found profile"
            ], 500);
        }

        return response()->json([
            "status" => true,
            "message" => "Edit completed successfully"
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
