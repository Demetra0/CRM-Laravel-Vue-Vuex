<?php

namespace Database\Factories;

use App\Models\Profiles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profiles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $response = Http::get('https://randomuser.me/api/')->json()['results'];
        return [
            'name' => $response[0]['name']['first'],
            'age' => $response[0]['dob']['age'],
            'email' => $response[0]['email'],
            'birth_data' => $response[0]['dob']['date'],
            'phone' =>  $response[0]['phone'],
            'picture' => $response[0]['picture']['large']
        ];
    }
}
