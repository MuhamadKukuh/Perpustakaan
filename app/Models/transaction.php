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
}
