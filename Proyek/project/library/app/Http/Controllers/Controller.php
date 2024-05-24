<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getNotif()
    {
        // $currentDate = Carbon::now()->toDateString();

        $data=Transaction::with('member')
        ->where('date_end', '<', Carbon::today())
        ->where('status', false)
        ->get();
        // $data = Member::select('transactions.id', 'members.name', Transaction::raw("DATEDIFF('$currentDate',transactions.date_end) AS hari"))
        //     ->join('transactions', 'transactions.id', '=', 'members.id')
        //     // ->where('date_end', '<', $currentDate)
        //     ->where('status', false)
        //     ->get();
       // dd($data[0]->diffDay);
        return $data;
    }

}
