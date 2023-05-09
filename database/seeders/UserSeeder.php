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
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => '$2y$10$xs64TcvGpUGacvfwnB7xsenQPEY3ORquwR58gA7YA6jVKzwy8vvq6',
            'phone' => '374985479',
            'role' => 'admin',
           
        ]);
    }
}
