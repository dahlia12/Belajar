<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0 ; $i < 50 ; $i++) {
            $trasaction = new Transaction;
            
            $trasaction->member_id =rand(1,20);
            $trasaction->date_start=$faker ->date('Y-m-d H:m:s');
            $trasaction->date_end = $faker ->date('Y-m-d H:m:s'); 

            $trasaction->save();
        }
    }
}
