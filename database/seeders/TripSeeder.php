<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            'country' => 'Greece',
            'city' => 'Athens',
            'begin_date' => Carbon::parse('2023-07-22'),
            'end_date' => Carbon::parse('2023-08-03'),
            'price_person' => 8079,
            'last_minute' => 0,
            'food_option' => 'All Inclusive',
            'participants_number_left' => 5
        ]);

        DB::table('trips')->insert([
            'country' => 'Greece',
            'city' => 'Planos',
            'begin_date' => Carbon::parse('2023-06-07'),
            'end_date' => Carbon::parse('2023-06-10'),
            'price_person' => 3949,
            'last_minute' => 1,
            'food_option' => 'All Inclusive',
            'participants_number_left' => 12
        ]);

        DB::table('trips')->insert([
            'country' => 'Greece',
            'city' => 'Ouranopolis',
            'begin_date' => Carbon::parse('2023-09-26'),
            'end_date' => Carbon::parse('2023-09-30'),
            'price_person' => 1789,
            'last_minute' => 0,
            'food_option' => 'Breakfast and Dinner',
            'participants_number_left' => 5
        ]);


        DB::table('trips')->insert([
            'country' => 'Egypt',
            'city' => 'Hurghada',
            'begin_date' => Carbon::parse('2023-05-26'),
            'end_date' => Carbon::parse('2023-06-02'),
            'price_person' => 2698,
            'last_minute' => 1,
            'food_option' => 'All Inclusive',
            'participants_number_left' => 8
        ]);

        DB::table('trips')->insert([
            'country' => 'Egypt',
            'city' => 'Marsa Alam',
            'begin_date' => Carbon::parse('2023-12-13'),
            'end_date' => Carbon::parse('2023-12-20'),
            'price_person' => 3198,
            'last_minute' => 0,
            'food_option' => 'All Inclusive',
            'participants_number_left' => 27
        ]);

        DB::table('trips')->insert([
            'country' => 'Spain',
            'city' => 'Benalmadena',
            'begin_date' => Carbon::parse('2023-06-06'),
            'end_date' => Carbon::parse('2023-06-14'),
            'price_person' => 3889,
            'last_minute' => 1,
            'food_option' => 'Breakfast',
            'participants_number_left' => 16
        ]);
    }
}
