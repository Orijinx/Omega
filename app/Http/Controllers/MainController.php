<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //
    public function MainView(){
        $users = User::all();
        return view("index",compact("users"));
    }
}
