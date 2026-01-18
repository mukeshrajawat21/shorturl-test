<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */


    public function run(): void
    {
         $this->call([
            SuperAdminSeeder::class,
            AdminSeeder::class

        ]);

        // User::factory()->create([
        //     'name' => 'Super admin',
        //     'email' => 'superadmin@gmail.com',
        //     'password' => Hash::make('admin')
        // ]);
    }
}
