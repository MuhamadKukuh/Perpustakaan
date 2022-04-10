<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\User;
use App\Models\favorite;
use App\Models\transaction;
use Illuminate\Http\Request;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('Dashboard.dashboard', [
            'onlineUsers'   => User::where('id_role', 2)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(10)->get(),
            'title'         => 'Dashboard',
            'message'       => transaction::where('status', 0)->get(),
            'borrowed'      => transaction::orderBy('updated_at', 'DESC')->get()
        ]);
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
        //
    }

    public function profile(User $user){
        // @dd($user->id_role);

        $siswa = User::where('id', $user->id)->first();
        $title  = 'Profile';
        $favorite = favorite::where('id_user', $user->id)->limit(5)->get();

        // @dd($favorite);
        
        return view('profile', compact('siswa', 'title', 'favorite'));
    }

    public function studentslist(){
        $students = User::where('id_role', 2)
                        ->join('kelas', 'kelas.id_kelas', '=', 'users.id_kelas')
                        ->join('genders', 'genders.id_gender', '=', 'users.id_gender')
                        ->orderBy('nis', 'ASC')
                        ->get();

        $title    = 'Students';

        $no       = 1;

        return view('Dashboard.students', compact('students', 'title', 'no'));
    }


    public function message(){
        $title = 'Message';
        $confirmation = transaction::where('status', 0)->get();
        $confirmationReturn = transaction::where('status', 1)->get();
        $no = 1;

        return view('Dashboard.message', compact('title', 'no', 'confirmation', 'confirmationReturn'));
    }

    public function confirm($id){
        $core = transaction::where('id_transaction', $id)->first();
        $core2 = book::where('id_books', $core->id_book)->first();

        // @dd($core->total);
        $update = transaction::where('id_transaction', $id)
                             ->update([
                                 'status'   => 1
                             ]);
        if($update){
            $min = $core2->bookTotal - $core->total;
            book::where('id_books', $core->id_book)->update([
                'bookTotal' => $min
            ]);
        }

        return back()->with('succes', 'Confirmation Succes');
    }

    public function deleteC($id){
        transaction::destroy($id);
        return back()->with('succes', 'Confirmation has been deleted');
    }

    public function destroyAll(){
        transaction::where('status', 0)->delete();

        return back()->with('success', 'All transaction has been deleted');
    }
}
