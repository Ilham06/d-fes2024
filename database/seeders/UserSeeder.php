<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Ilham Muhamad',
            'email' => 'ilham@kampusdev.com',
            'password' => Hash::make('passwordilham1999*!'),
            'is_admin' => true
        ];

        User::create($user);
    }
}
