<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    // when installed via composer
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);
    }
}
