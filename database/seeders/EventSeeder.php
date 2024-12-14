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
                'name' => $faker->unique()->company(), // Nombre más realista o
                'location' => $faker->city, // Genera un nombre de ciudad
                'date'=> $faker->dateTimeBetween($startDate = '-3 month',$endDate = 'now +6 month'),
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2,100,3000),
                'created_at' => now(), // Timestamp actual
                'updated_at' => now(), // Timestamp actual
                // 'cover_image' => $faker->imageUrl(800, 600, 'abstract', true, 'cover'),
                // 'venue_image' => $faker->imageUrl(800, 600, 'city', true, 'venue'),

                'cover_image' => 'https://picsum.photos/seed/' . uniqid() . '/200',
                'venue_image' => 'https://picsum.photos/200' . uniqid() . '/200'
            ]);
        }
    }
}
