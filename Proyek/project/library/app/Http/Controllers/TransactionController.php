<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $transactions = Transaction::all();
        $notifs = Controller::getNotif();
        //return $transactions;
        return view('admin.transaction', compact('transactions','notifs'));
    }

    public function api()
    {
        $transactions = Transaction :: with(['member', 'transactiondetails'])->get();
        foreach ($transactions as $transaction) {
            // if($transaction -> transactiondetail -> book == null){
            //     dd($transaction->transactiondetail);
            // }
            $transaction["name"] = $transaction -> member -> name;
            $transaction["lama"] = $transaction -> lama;
            $transaction["qty"] = $transaction -> transactiondetails ->sum('qty');
            $transaction["total"]=0;
            foreach($transaction -> transactiondetails as $detail){
                $transaction["total"]+=$detail->book->price;
            }
            // $transaction["total"] = $transaction -> transactiondetails -> book -> sum('price');
        }
        $datatables = datatables()->of($transactions)->addIndexColumn();

        return $datatables ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = Controller::getNotif();
        $members=Member::all();
        $books=Book::all();
        return view('admin.create',['members'=>$members,'books'=>$books,'notifs'=>$notifs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'date_start'  =>['required'],
            'date_end'  =>['required'],
            'member_id'  =>['required'],
        ]);
        $transaction=Transaction::create([
            "member_id"=>request('member_id'),
            "date_start"=>request('date_start'),
            "date_end"=>request('date_end'),
            "id_transaction"=>"X"
        ]);

        foreach(request('books') as $book_id){
            TransactionDetail::create([
                "transaction_id"=>$transaction->id,
                "id_DTransaction"=>"X",
                "book_id"=>$book_id,
                "qty"=>1
            ]);
        }
        // // $transaction = new transaction;
        // // $transaction ->id_transaction =$request ->id_transaction;
        // // $transaction ->name = $request ->name;
        // // $transaction->save();

        return redirect('transactions');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        //dd("hallo");
        $notifs = Controller::getNotif();
        $transaction = Transaction::with('transactiondetails')->find($id);
        $members=Member::all();
        $books=Book::all();

        return view('admin.edit', compact('transaction','members','books','notifs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request,[
            'tanggal_pinjam'  =>['required'],
            'tanggal_kembali'  =>['required'],
            'nama'  =>['required'],
            'hari'  =>['required'],
            'total_buku'  =>['required'],
            'total_bayar'  =>['required'],
        ]);

        $transaction->update( $request->all());
        
        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('transactions');
    }
}
