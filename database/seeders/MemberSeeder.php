<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
       
        $company = DB::table('companies')->first();
        if (!$company) {
            $companyId = DB::table('companies')->insertGetId([
                'name' => 'Abc Company',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $companyId = $company->id;
        }

        $existing = DB::table('users')->where('email', 'membertest@gmail.com')->first();
        if (!$existing) {
            DB::table('users')->insert([
                'name' => 'Test Member',
                'email' => 'membertest@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'Member',
                'company_id' => $companyId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "Member created successfully in company_id = $companyId\n";
        } else {
            echo "Member already exists, skipping insert.\n";
        }
    }
}
