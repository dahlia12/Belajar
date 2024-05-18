<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $catalogs = Catalog::all();

        //return $Catalogs;
        return view('admin.catalog', compact('catalogs'));


    }
    
    public function api()
    {
        $catalogs = Catalog :: all();

        // foreach ($catalogs as $key => $catalog){
        //     $catalog->date = convert_date($catalog->created_at);

        // }

        $datables = datatables()->of($catalogs)
                                ->addIndexColumn('date',function($catalog){
                                    return convert_date($catalog->created_at);
                                })->addIndexColumn();

        return $datables ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->validate($request,[
            'id_catalog'  =>['required'],
            'name'  =>['required'],
        ]);
        // $Catalog = new Catalog;
        // $Catalog ->id_Catalog =$request ->id_Catalog;
        // $Catalog ->name = $request ->name;
        // // $Catalog->save();

        Catalog::create('$request->all()');
        
        return redirect('catalogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog= Catalog::where('id',$id)->first();

            // $Catalog = Catalog::select('*')
            // ->where('id', $id)
            // ->first();
        return view('admin.catalog.edit',compact('catalogs'));

        //return view('admin.Catalog.edit',compact('Catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $this->validate($request,[
            'id_catalog'  =>['required'],
            'name'  =>['required'],
        ]);

        $catalog->update( $request->all());
        
        return redirect('catalog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();

        return redirect('catalogs');
    }
}
