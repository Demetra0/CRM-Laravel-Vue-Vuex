<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_success() {
        $response = $this->post('/api/auth/register',[
            "name" => "Ivan",
            "email" => Str::random(10) . "@test.dev",
            "password" => "password123"
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            "status" => true
        ]);
    }
    public function test_register_insert_success() {
        $email = Str::random(10) . "@test.dev";

        $response = $this->post('/api/auth/register',[
            "name" => "Ivan",
            "email" => $email,
            "password" => "password123"
        ]);

        $this->assertEquals(true, User::where("email", $email)->exists());
    }
    public function test_register_unique_error() {
        $response = $this->post('/api/auth/register',[
            "name" => "Ivan",
            "email" => User::select("email")->first()->email,
            "password" => "password123"
        ]);
        $response->assertJson([
            "status" => false
        ]);
    }
    public function test_register_error_validation_status()
    {
        $response = $this->post('/api/auth/register',[
            "name" => "Ivan",
            "password" => "password123"
        ]);

        $response->assertStatus(422);
    }
}
