<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\department_conn;

class department extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsToMany(department_conn::class,'departmentconns','dep_id','user_id')->withTimestamps();
    }
}
