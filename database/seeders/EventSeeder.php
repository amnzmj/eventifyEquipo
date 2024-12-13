<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Instanciar Faker

        foreach (range(1,10) as $index) {
            DB::table('events')->insert([
                'name' => Str::random(10),
                'location' => $faker->city, // Genera un nombre de ciudad
                'date'=> $faker->dateTimeBetween($startDate = '-3 month',$endDate = 'now +6 month'),
                'description' => Str::random(60),
                'price' => $faker->randomFloat(2,100,3000),
                'created_at' => now(), // Timestamp actual
                'updated_at' => now(), // Timestamp actual
            ]);
        }
    }
}
