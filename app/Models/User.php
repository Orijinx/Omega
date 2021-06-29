<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\department;
use App\Models\position;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Связь к департаментам
    public function departments(){
        return $this->belongsToMany(department::class,'department_conns','user_id','dep_id');
    }
    //Связь к файлам
    public function files(){
        return $this->belongsTo(file::class,'id','user_id');
    }
    //Связь к должности
    public function position(){
        return $this->hasOne(Position::class,'id','position_id');
    }
}
