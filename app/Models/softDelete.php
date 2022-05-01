<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class softDelete extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
