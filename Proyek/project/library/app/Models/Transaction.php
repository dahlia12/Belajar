<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $label = ['id_transaction','member_id','date_start','date_end'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function getLamaAttribute(){
        $end = date_create($this->date_end);
        $start = date_create($this->date_start);
        return date_diff($start,$end)->format("%R%a");
    }
    public function transactiondetails()
    {
        return $this->hasMany(TransactionDetail::class)->with('book');
    }
}
