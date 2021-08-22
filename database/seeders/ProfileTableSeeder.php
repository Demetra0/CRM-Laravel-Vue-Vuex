<?php

namespace Database\Seeders;

use App\Models\FormUnderConsideration;
use App\Models\Profiles;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Profiles::factory()->count(10)->create();
    }
}
