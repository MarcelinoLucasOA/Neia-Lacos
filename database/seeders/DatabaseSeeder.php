<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Quilograma', 'symbol' => 'Kg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grama', 'symbol' => 'g', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Litro', 'symbol' => 'L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mililitro', 'symbol' => 'mL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Unidade', 'symbol' => 'Un', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Metro', 'symbol' => 'm', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Centímetro', 'symbol' => 'cm', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Caixa', 'symbol' => 'Cx', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('units')->insert($units);
    }
}
