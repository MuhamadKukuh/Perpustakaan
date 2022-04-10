<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\book;    
use App\Models\favorite;
use App\Models\view;    
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
        $fictions = book::where('id_category', 1)->get();
        $nonFictions = book::where('id_category', 2)->get();
        $title = 'Home';

        return view('Home.home', compact('fictions', 'nonFictions', 'title'));
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


        return view('Home.book', compact('book', 'title', 'viewer', 'recomendations', 'favorite'));

    }
}
