<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $companyId = DB::table('companies')->insertGetId([
            'name' => 'Company A',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), 
            'role' => 'Admin',
            'company_id' => $companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    
        DB::table('users')->insert([
            'name' => 'Sales User',
            'email' => 'sales@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Sales',
            'company_id' => $companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Manager',
            'company_id' => $companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        DB::table('users')->insert([
            'name' => 'Member User',
            'email' => 'member@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Member',
            'company_id' => $companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
