<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_transaction';

    protected $guarded    = ['id_transaction'];

    public function user(){
        return $this->belongsTo(user::class, 'id_user');
    }

    public function book(){
        return $this->belongsTo(book::class, 'id_book');
    }

    public function countTax($tax, $deadline, $totalBook){
        $tanggal = strtotime(date('Y-m-d'));
        $deadline2 = strtotime($deadline);

        $totalDeadline = $tanggal - $deadline2;

        $hari = $totalDeadline / 60 / 60 / 24;

        if($totalDeadline < 0){
            return '-';
        }else{
            $taxTotal = $hari * $tax * $totalBook;

            
            return number_format($taxTotal, 0, '', '. ');
        }
    }
}
