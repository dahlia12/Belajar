<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
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
        $publishers = Publisher::all();
        $notifs = Controller::getNotif();
        //return $publishers;
        return view('admin.publisher', compact('publishers','notifs'));
    }

    public function api()
    {
        $publishers = Publisher :: all();
        $datables = datatables()->of($publishers)->addIndexColumn();

        return $datables ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publisher.create');
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
            'id_publisher'  =>['required'],
            'name'  =>['required'],
            'email'  =>['required'],
            'phone_number'  =>['required'],
            'address'  =>['required'],
        ]);
        // // $publisher = new publisher;
        // // $publisher ->id_publisher =$request ->id_publisher;
        // // $publisher ->name = $request ->name;
        // // $publisher->save();

        Publisher::create('$request->all()');
        
        return redirect('publisher');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $publisher = Publisher::select('*')
        ->where('id', $id)
        ->first();

        return view('admin.publisher.edit', compact('publishers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $this->validate($request,[
            'id_publisher'  =>['required'],
            'name'  =>['required'],
            'email'  =>['required'],
            'phone_number'  =>['required'],
            'address'  =>['required'],
        ]);

        $publisher->update( $request->all());
        
        return redirect('publishers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect('publishers');
    }
}
