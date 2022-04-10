<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\kelas;
use App\Models\category;
use App\Models\favorite;
use App\Models\bookshelf;
use App\Models\transaction;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class booksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;

        $books = book::join('bookshelves', 'bookshelves.id_bookshelf', '=', 'books.id_bookshelf')
        ->join('categories', 'categories.id_category', '=', 'books.id_category')->orderBy('bookTitle', 'DESC')->get();
        
        $title = 'Books';

        return view('Dashboard.books', compact('books', 'title', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @dd($request->all());
        $request->validate([
            'title' => 'required',
            'total' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);


        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('bookImages'), $imageName);


            book::create([
                'bookTitle'   => $request->title,
                'id_category' => $request->category,
                'id_kelas'    => $request->try,
                'id_bookshelf'=> $request->bookshelf,
                'genre'       => $request->genre,
                'bookTotal'   => $request->total,
                'bookImage'   => $imageName,
                'tax'         => $request->tax,
                'fine'        => $request->fine   
            ]);

        return redirect('/addbook');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = book::where('id_books', $id)->first();
        $title= 'Edit Book';

        return view('Dashboard.editbook', compact('books', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        book::destroy('id_books', $id);

        return redirect('/books')->with('success', 'Success deleting book');
    }

    public function add(){
        $title = 'Add Book';
        $category = category::all();
        $kelas = kelas::all();
        $bookshelf = bookshelf::all();


        return view('Dashboard.addbook', compact('title', 'category', 'bookshelf', 'kelas'));
    }

    public function addF($id){
        // dd( $id);

        favorite::create([
            'id_user' => Auth()->User()->id,
            'id_book' => $id
        ]);

        return redirect('/book/'. $id . '')->with('succes', 'Succes Add from favorite');
    }

    public function dropF( $id){
        favorite::where('id_user', Auth()->User()->id)->where('id_book', $id)->delete();
        return redirect('/book/'. $id . '')->with('succes', 'Succes Add from favorite');
    }

    public function borrow(Request $request, $id){
        // @dd(date('Y-m-d'), $request->date);
        
        $cek = book::where('id_books', $id)->first();
        $request->validate([
            'count' => 'required',
            'date'  => 'required'
        ]);

        if($request->date('Y-m-d') == $request->date){
            return back()->with('error', 'form must require');
        }elseif($request->count > $cek->bookTotal){
            return back()->with('error', 'out of stock');
        }else{
            $cek = transaction::create([
                'id_user'   => Auth()->User()->id,
                'id_book'   => $id,
                'deadline'  => $request->date,
                'total'     => $request->count,
                'status'    => 0
            ]);

            return redirect('/book/'. $id .'')->with('succes', 'Succes, Please Wait');
        }

       
    }
}
