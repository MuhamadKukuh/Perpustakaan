<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $primaryKey = 'id_user';

    protected $guarded = [
        'id_user'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function nisFormat($nis){
        $format = sprintf('%s.%s.%s', 
                          substr($nis, 0, 4),
                          substr($nis, 4, 2),
                          substr($nis, 6));
        return $format;
    }

    public function kelas(){
        return $this->belongsTo(kelas::class, 'id_kelas');
    }
    public function gender(){
        return $this->belongsTo(gender::class, 'id_gender');
    }
}
