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
        $status1=Status::create(['status' => 'Activo']);
        $status2=Status::create(['status' => 'Inactivo']);
        $status3=Status::create(['status' => 'Realizado']);
    }
}
