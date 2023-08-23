<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Admin::whereRole(0)->count() == 0)
        {
            Admin::updateOrCreate([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(123456),
                'role' => 0
            ]);
        }
        if(Admin::whereRole(1)->count() == 0)
        {
            Admin::updateOrCreate([
                'name' => 'CPA',
                'email' => 'cpa@gmail.com',
                'password' => bcrypt(123456),
                'role' => 1
            ]);
        }
    }
}