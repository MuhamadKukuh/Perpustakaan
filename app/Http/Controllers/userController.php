<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\book;    
use App\Models\favorite;
use App\Models\view;    
use App\Models\bookshelf;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fictions = book::where('id_category', 1)->orderBy('updated_at', 'DESC')->get();
        $nonFictions = book::where('id_category', 2)->orderBy('updated_at', 'DESC')->get();
        $title = 'Home';
        $bookshelf = bookshelf::all();
        $crousel = book::orderBy('created_at', 'DESC')->limit(3)->get();
        $crouselNo = $crousel->first();
        $no = 0;

        return view('Home.home', compact('fictions', 'nonFictions', 'title', 'bookshelf', 'crousel', 'no', 'crouselNo'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $return = User::where('id', $id)->first();

        if(!$request->cek){
            return back()->with('error', 'Please click the check box');
        }else{
            User::where('id', $id)
                ->update([
                    'location'  => $request->location,
                    'bio'       => $request->bio
                ]);

            return redirect('/profile/'. $return->username)->with('succes', 'Profile has been Change');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showe($id){
        $book = book::where('id_books', $id)->first();
        // dd($id);
        $title= "Book";

        $cek = view::where('id_book', $id)->where('id_user', Auth()->User()->id)->get();

        if($cek->count() == 0){
            view::create([
                'id_book'   => $id,
                'id_user'   => Auth()->User()->id
            ]);
        }
        
        $viewer = view::where('id_book', $id)->get();
        $recomendations = book::orderBy('created_at', 'DESC')->limit(4)->get();

        $favorite = favorite::where('id_user', Auth()->User()->id)->where('id_book', $id)->first();
        $bookshelf = bookshelf::all();



        return view('Home.book', compact('book', 'title', 'viewer', 'recomendations', 'favorite', 'bookshelf'));

    }

    public function showBook($name){

        $data = bookshelf::where('nameBookshelf', $name)->first();

        $fictions = book::where('id_category', 1)->where('id_bookshelf', $data->id_bookshelf)->orderBy('updated_at', 'DESC')->get();
        $nonFictions = book::where('id_category', 2)->where('id_bookshelf', $data->id_bookshelf)->orderBy('updated_at', 'DESC')->get();
        $title = $name;
        // @dd($name);
        $bookshelf = bookshelf::all();
        return view('Home.books', compact('bookshelf', 'title', 'fictions', 'nonFictions' ));
    }

    public function showFavorite(){

        // $data = bookshelf::where('nameBookshelf', $name)->first();

        $bookFavorite = favorite::where('id_user', Auth()->User()->id)->get();

        // $fictions = book::where('id_category', 1)->where('id_bookshelf', $data->id_bookshelf)->orderBy('updated_at', 'DESC')->get();
        // $nonFictions = book::where('id_category', 2)->where('id_bookshelf', $data->id_bookshelf)->orderBy('updated_at', 'DESC')->get();
        $title = 'Favorite Book';
        // @dd($name);
        $bookshelf = bookshelf::all();
        return view('Home.favorite', compact('bookshelf', 'title', 'bookFavorite' ));
    }
}
