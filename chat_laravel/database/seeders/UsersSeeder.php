<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "email" => "user_a@gmail.com",
                "username" => "user_a",
                "password" => Hash::make('123123')
            ],
            [
                "email" => "user_b@gmail.com",
                "username" => "user_b",
                "password" => Hash::make('123123')
            ],
            [
                "email" => "user_c@gmail.com",
                "username" => "user_c",
                "password" => Hash::make('123123')
            ]
        ]);
    }
}
