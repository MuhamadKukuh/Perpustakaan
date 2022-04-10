<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_view';
    protected $guarded    = ['id_view'];
}
