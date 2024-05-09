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
            $trasactiondetail->transactiondetail_id =Transaction::inRandomOrder()->first()->id;
            $trasactiondetail->book_id = Book::inRandomOrder()->first()->id;
            $trasactiondetail->qty=rand(10,20);
            
            $trasactiondetail->save();
        }
    }
}
