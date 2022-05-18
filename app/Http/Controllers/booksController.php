<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\kelas;
use App\Models\history;
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
        ->join('categories', 'categories.id_category', '=', 'books.id_category')->orderBy('books.updated_at', 'DESC')->get();
        
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
            'tax'   => 'required',
            'fine'  => 'required',
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

        return redirect('/books')->with('success', 'Succes Added Book');
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
        $category = category::all();
        $kelas = kelas::all();
        $bookshelf = bookshelf::all();
        $title= 'Edit Book';

        return view('Dashboard.editbook', compact('books', 'title', 'kelas', 'bookshelf', 'category'));
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
        $request->validate([
            'title' => 'required',
            'total' => 'required',
            'tax'   => 'required',
            'fine'  => 'required'
        ]);

        if($request->image == null){
            // @dd($request->category);
            book::where('id_books', $id)
                ->update([
                'bookTitle'   => $request->title,
                'id_category' => $request->category,
                'id_kelas'    => $request->try,
                'id_bookshelf'=> $request->bookshelf,
                'genre'       => $request->genre,
                'bookTotal'   => $request->total,
                'tax'         => $request->tax,
                'fine'        => $request->fine   
            ]);
        }else{
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);

            $imageName = time().'.'.$request->image->extension();  
     
            $request->image->move(public_path('bookImages'), $imageName);



            book::where('id_books', $id)
                ->update([
                'bookTitle'   => $request->title,
                'id_category' => $request->category,
                'id_kelas'    => $request->try,
                'id_bookshelf'=> $request->bookshelf,
                'genre'       => $request->genre,
                'bookTotal'   => $request->total,
                'tax'         => $request->tax,
                'bookImage'   => $imageName,
                'fine'        => $request->fine   
            ]);
        }


        return redirect('/books')->with('success', 'Succes Edit Book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        transaction::where('id_book', $id)->delete();
        history::where('id_books', $id)->delete();
        // @dd($id, history::all());
        favorite::where('id_book', $id)->delete();
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

        return redirect('/book/'. $id . '')->with('success', 'Success add to favorite');
    }

    public function dropF( $id){
        favorite::where('id_user', Auth()->User()->id)->where('id_book', $id)->delete();
        return redirect('/book/'. $id . '')->with('success', 'Succes Add remove from favorite');
    }

    public function borrow(Request $request, $id){
        // @dd(date('Y-m-d'), $request->date);
        
        $cek = book::where('id_books', $id)->first();
        $request->validate([
            'count' => 'required',
            'date'  => 'required'
        ]);

        $tanggal = strtotime(date('Y-m-d'));
        $deadline2 = strtotime($request->date);

        $totalDeadline = $deadline2 - $tanggal  ;

        $hari = $totalDeadline / 60 / 60 / 24;
        // @dd($hari);

        if(date('Y-m-d') == $request->date){
            return back()->with('error', 'Please Cek the Date');
        }elseif($request->count > $cek->bookTotal){
            return back()->with('error', 'out of stock');
        }elseif($totalDeadline < 0 || $hari > 30){
            return back()->with('error', 'Please check your deadline');
        }else{
            $cek = transaction::create([
                'id_user'   => Auth()->User()->id,
                'id_book'   => $id,
                'deadline'  => $request->date,
                'total'     => $request->count,
                'status'    => 0
            ]);

            history::create([
                'id_user' => Auth()->User()->id,
                'id_books' => $id,
                'totalborrw' => $request->count,
                'status'  => 0
            ]);

            return redirect('/book/'. $id .'')->with('success', 'Succes, Please Wait');
        }

       
    }
}
