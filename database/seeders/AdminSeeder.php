<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'email' => 'ayeshasultanatofa1002@example.com',
            'password' => '12345678',
            'role' => 'admin', 
            'dep_id' => 1
        ]);
    }
}
