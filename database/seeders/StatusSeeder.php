<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['status' => 'Pending']);
        Status::create(['status' => 'Approve']);
        Status::create(['status' => 'Processing']);
        Status::create(['status' => 'Cancel']);
        Status::create(['status' => 'Denied']);
        Status::create(['status' => 'Cash']);
    }
}