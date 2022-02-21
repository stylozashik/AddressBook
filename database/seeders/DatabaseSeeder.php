<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Ramsey\Uuid\Type\Integer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach( range( 1 , 100 ) as $index ){
            DB::table('contacts')->insert([
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'birthday' => $faker->date,
            ]);
        }
    }
}
