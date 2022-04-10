<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_favorite';
    protected $guarded    = ['id_favorite'];

    public function book(){
        return $this->belongsTo(book::class, 'id_book');
    }
}
