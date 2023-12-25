<?php

namespace Database\Seeders;

use App\Models\Priorities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priorities::create(['level' => 'Alta']);
        Priorities::create(['level' => 'Media']);
        Priorities::create(['level' => 'Baja']);
    }
}
