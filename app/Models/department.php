<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class department extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsToMany(User::class,'department_conns','dep_id','user_id');
    }
}
