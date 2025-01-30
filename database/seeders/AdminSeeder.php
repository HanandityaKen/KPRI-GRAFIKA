<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'nama'  => 'admin',
            'username' => 'admin',
            'password' => Hash::make('pak mahmudi'), 
            'telepon' => '0882009964296', 
        ]);
    }
}
