<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        for ($i=0; $i < 20; $i++){
            $publisher = new Publisher;
            
            $publisher->name = $faker->name;
            $publisher->gender = $faker->randomElement($array = array('M','F'));
            $publisher->phone_number = '0852'.$faker->randomNumber(8); 
            $publisher->address = $faker->address; 
            $publisher->email = $faker->email;

            $publisher->save();
        }
    }
}
