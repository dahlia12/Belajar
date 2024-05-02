<?php

namespace Database\Seeders;


use Faker\Factory as Faker;
use App\Models\TransactionDetail;
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
            $trasactiondetail = new TransactionDetail;
            
            $trasactiondetail->id_DTransaction ='DTSC'.$faker ->randomNumber(6,false);
            $trasactiondetail->transactiondetail_id =rand(1,50);
            $trasactiondetail->book_id = rand(1,20);
            $trasactiondetail->qty=rand(10,20);
            
            $trasactiondetail->save();
        }
    }
}
