<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Wilder Wilches',
                'email' => 'wilderwil@gmail.com',
                'password' => bcrypt('123456'),
            ]
        )->assignRole('Admin');
        User::create(
            [
                'name' => 'Javier Duque',
                'email' => 'wilderwil@hotmail.com',
                'password' => bcrypt('123456'),
            ]
        )->assignRole('Jefe');
    }
}