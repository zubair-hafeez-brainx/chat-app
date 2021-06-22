<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['email' => 'zubairhafeez56@gmail.com'], [
            'name' => 'Zubair Hafeez',
            'email' => 'zubairhafeez56@gmail.com',
            'password' => Hash::make('Password123@'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        User::firstOrCreate(['email' => 'umair@gmail.com'], [
            'name' => 'Umair Hafeez',
            'email' => 'umair@gmail.com',
            'password' => Hash::make('Password123@'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        User::firstOrCreate(['email' => 'faizan@gmail.com'], [
            'name' => 'Faizan Khalid',
            'email' => 'faizan@gmail.com',
            'password' => Hash::make('Password123@'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        User::firstOrCreate(['email' => 'ali@gmail.com'], [
            'name' => 'Ali Haroon',
            'email' => 'ali@gmail.com',
            'password' => Hash::make('Password123@'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        User::firstOrCreate(['email' => 'shoaib@gmail.com'], [
            'name' => 'Shoaib Ahmad',
            'email' => 'shoaib@gmail.com',
            'password' => Hash::make('Password123@'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
