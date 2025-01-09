<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Cairo', 'governorate_id' => 1],
            ['name' => 'Giza', 'governorate_id' => 1],
            ['name' => 'Alexandria', 'governorate_id' => 1],
            ['name' => 'Mansoura', 'governorate_id' => 1],
            ['name' => 'Aswan', 'governorate_id' => 2],
            ['name' => 'Luxor', 'governorate_id' => 2],
            ['name' => 'Asyut', 'governorate_id' => 2],
            ['name' => 'Suez', 'governorate_id' => 3],
            ['name' => 'Port Said', 'governorate_id' => 3],
            ['name' => 'Damietta', 'governorate_id' => 3],
        ];
        City::insert($cities);
    }
}
