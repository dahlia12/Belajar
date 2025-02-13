<?php

namespace Database\Seeders;

use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0 ; $i < 20 ; $i++) {
            $member = new Member;
            
            $member->name = $faker -> name;
            $member -> gender = $faker->randomElement($array = array('M','F'));
            $member->phone_number='0823'.$faker ->randomNumber(8);
            $member->address = $faker -> address;
            $member->email = $faker -> email;

            $member->save();
        }
    }
}
