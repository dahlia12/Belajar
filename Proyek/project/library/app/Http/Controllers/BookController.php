<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Publisher;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $books = Book::all();
        
        // // return $books;
        

        // $publishers = Publisher::get(); 
        // $authors = Author::get();
        // $catalogs = Catalog ::get();
        $notifs = Controller::getNotif();
            $publishers = Publisher::all();
            $authors = Author::all();
            $catalogs = Catalog::all();

            return view('admin.book', compact('publishers', 'authors', 'catalogs','notifs'));

        // return view("admin.book",[
        // "publishers" => $publishers,
        // "authors" => $authors,
        // "catalogs" => $catalogs,
        // ]);
    }
    
    public function api()
    {
        $books = Book::all();

        return json_encode($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.book.create');
        
        // $publishers = Publisher::get(); 
        // $authors = Author::get();
        // $catalogs = Catalog ::get();

        // return view("admin.book.create",[
        // "publishers" => $publishers,
        // "authors" => $authors,
        // "catalogs" => $catalogs,
        // ]);

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
            'isbn'  =>['required'],
            'title'  =>['required'],
            'year'  =>['required'],
            'publisher_id'  =>['required'],
            'author_id'  =>['required'],
            'catalog_id'  =>['required'],
            'qty'  =>['required'],
            'price'  =>['required'],
        ]);
        // $book = new Book;
        // $book ->id_book =$request ->id_book;
        // $book ->name = $request ->name;
        // $book->save();

        Book::create('$request->all()');
        
        return redirect('book');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $book = Book::select('*')
            ->where('id', $id)
            ->first();

        $publishers = Publisher::get(); 
        $authors = Author::get();
        $catalogs = Catalog ::get();
        
        return view("admin.book.edit",compact('book','publishers','authors','catalogs',));

        // return view('admin.book.edit',compact('book'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //dd($request->all());

        $this->validate($request,[  
                'isbn'  =>['required'],
                'title'  =>['required'],
                'year'  =>['required'],
                'publisher_id'  =>['required'],
                'author_id'  =>['required'],
                'catalog_id'  =>['required'],
                'qty'  =>['required'],
                'price'  =>['required'],
        ]);

        $book->update( $request->all());
        
        return redirect('book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {   dd ("$book");
        $book->delete();

        return redirect('book');
    }
}
