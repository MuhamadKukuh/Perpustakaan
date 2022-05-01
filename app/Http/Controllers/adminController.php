<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\User;
use App\Models\history;
use App\Models\favorite;
use App\Models\softDelete;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'borrowed'      => transaction::orderBy('updated_at', 'DESC')->get(),
            'students'      => User::Where('id_role', 2)->get(),
            'book'          => book::all(),
            'return'        => transaction::where('status', 1)->get()
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
        // $date = date('Y-m-d');
        $histories = history::where('id_user', $user->id)->orderBy('created_at', 'DESC')->get();
        $activities = history::where('id_user', $user->id)->where('status', 0)->get();
        $borrow = transaction::where('id_user', $user->id)->where('status', 1)->get();
        // @dd($histories);
        
        return view('profile', compact('siswa', 'title', 'favorite', 'histories', 'activities', 'borrow'));
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
        $confirmation = transaction::where('status', 0)->orderBy('created_at', 'DESC')->get();
        // $confirmationReturn = transaction::where('status', 1)->get();
        $no = 1;

        return view('Dashboard.message', compact('title', 'no', 'confirmation'));
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

        history::create([
            'id_user' => $core->id_user,
            'id_books' => $core->id_book,
            'totalborrw' => $core->total,
            'status'  => 1
        ]);

        return back()->with('succes', 'Confirmation Succes');
    }

    public function deleteC($id){
        $data = transaction::where('id_transaction', $id)->first();

        softDelete::create([
            'id_user'   => $data->id_user,
            'id_book'   => $data->id_book,
            'total'     => $data->total,
            'deadline'  => $data->deadline,
            'status'    => $data->status
        ]);

        history::create([
            'id_user' => $data->id_user,
            'id_books'=> $data->id_book,
            'totalborrw'   => $data->total,
            'status'    => 5
        ]);


        transaction::destroy($id);

        return back()->with('succes', 'Confirmation has been deleted');
    }

    public function destroyAll(){
        transaction::where('status', 0)->delete();

        return back()->with('success', 'All transaction has been deleted');
    }

    public function returnBook(){
        $title = "Return";
        $data  = transaction::orderBy('created_at', 'DESC')->get();
        $no    = 1;

        return view('Dashboard.return', compact('title', 'data', 'no'));
    }

    public function returnBook1($id){
        $data = transaction::Where('id_transaction', $id)->first();
        $dataBook = book::where('id_books', $data->id_book)->first();

        $total = $dataBook->bookTotal + $data->total;

        transaction::where('id_transaction', $id)
                   ->update([
                       'status'  => 2
                   ]);

        book::where('id_books', $data->id_book)
            ->update([
                'bookTotal' => $total
            ]);

        history::create([
            'id_books' => $data->id_book,
            'id_user' => $data->id_user,
            'status'  => 2,
            'totalborrw' => $data->total
        ]);

        return redirect('/return')->with('success', 'Success Returning Book');
    }
}
