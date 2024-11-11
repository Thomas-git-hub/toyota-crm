<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminType = Usertype::where('name', 'SuperAdmin')->first();
        if (!$superAdminType) {
            return;
        }

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@gmail.com',
            'usertype_id' => $superAdminType->id,
            'password' => Hash::make('123456'),
        ]);

    }
}
