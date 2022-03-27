<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelas';

    protected $guarded  = ['id_kelas'];

    public function user(){
        return $this->hasMany(User::class, 'id_kelas');
    }
}
