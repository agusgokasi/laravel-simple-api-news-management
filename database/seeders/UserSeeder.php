<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'role' => 'admin',
            'password' => bcrypt('admin1234'),
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('user1234'),
        ]);
    }
}
