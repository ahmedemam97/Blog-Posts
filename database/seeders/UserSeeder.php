<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
            'name' => 'Ahmed',
            'email' => 'ahmed@gmail.com',
            'password' => Hash::make('11111111')
        ],[ 
        'name' => 'mohamed',
        'email' => 'mohamed@gmail.com',
        'password' => Hash::make('33333333')]]);

        
        User::create([

            'name' => 'ali',
            'email' => 'ali@gmail.com',
            'password' => Hash::make('22222222')
    
        ]);
    }
}
