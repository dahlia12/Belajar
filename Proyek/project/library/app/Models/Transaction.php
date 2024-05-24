<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['id_transaction','member_id','date_start','date_end'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function getLamaAttribute(){
        $end = date_create($this->date_end);
        $start = date_create($this->date_start);
        return date_diff($start,$end)->format("%R%a");
    }
    public function getStatusAttribute($val){
        
        return $val==false?'Borrowed':'Finished';
    }
    public function getHariAttribute($val){
        $end = date_create($this->date_end);
        $start = Carbon::now();
        return date_diff($start,$end)->format("%R%a");
    }
    public function transactiondetails()
    {
        return $this->hasMany(TransactionDetail::class)->with('book');
    }
}
