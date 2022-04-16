<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;

    protected $primaryKey= 'id_history';

    protected $guarded = ['id_history'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function books(){
        return $this->belongsTo(book::class, 'id_books');
    }
}
