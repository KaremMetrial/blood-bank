<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            ['name' => 'Cairo'],
            ['name' => 'Alexandria'],
            ['name' => 'Giza'],
        ];

        DB::table('governorates')->insert($governorates);
    }
}
