<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
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
            $trasaction = new TransactionDetail;
            
            $trasaction->transaction_id =rand(1,50);
            $trasaction->book_id = rand(1,20);
            $trasaction->qty=rand(10,20);
            
            $trasaction->save();
        }

    }
}
