<?php

    namespace Database\Seeders;

    // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            // \App\Models\User::factory(10)->create();

            \App\Models\User::factory()->create([
                'name' => 'admin',
                'email' => 'karem.metrial@hotmail.com',
                'password' => bcrypt('123456789'),
            ]);

            $this->call([
                GovernoratesSeeder::class,
                BloodTypeSeeder::class,
                CitySeeder::class,
                ClientSeeder::class
            ]);
//         \App\Models\Contact::factory(10)->create();


        }
    }
