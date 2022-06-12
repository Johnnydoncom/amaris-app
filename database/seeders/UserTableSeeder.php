<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'        => 'Super',
            'last_name'         => 'Administrator',
            'email'             => 'john44real@gmail.com',
            'phone'             => '08031304346',
            'active'            => UserStatus::ACTIVE,
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(60)
        ]);

        User::create([
            'first_name'        => 'Site',
            'last_name'         => 'Administrator',
            'email'             => 'admin@example.com',
            'phone'             => '08031304347',
            'active'            => UserStatus::ACTIVE,
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(60)
        ]);

        User::create([
            'first_name'        => 'Shop',
            'last_name'         => 'Manager',
            'email'             => 'manager@example.com',
            'phone'             => '08031304348',
            'active'            => UserStatus::ACTIVE,
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(60)
        ]);

        User::create([
            'first_name'        => 'Account',
            'last_name'         => 'Customer',
            'email'             => 'customer@example.com',
            'phone'             => '08031304349',
            'active'            => UserStatus::ACTIVE,
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(60)
        ]);
    }
}
