<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ayesha Sultana Tofa',
            'email' => 'ayeshasultanatofa1002@gmail.com',
            'password' => Hash::make('12345678'), // Hashing the password
            'role' => 'admin', 
            'dep_id' => 1
        ]);
    }
}
