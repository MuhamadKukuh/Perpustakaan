<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_books';
    protected $guarded = ['id_books'];

    public function category(){
        return $this->belongsTo(category::class, 'id_category');
    }

    public function bookshelf(){
        return $this->belongsTo(bookshelf::class, 'id_bookshelf');
    }

    public function recomend(){
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function numberFormat($number){
        // $num = (int)$number;
        return number_format($number, 0, '.', '.');
    }
}
