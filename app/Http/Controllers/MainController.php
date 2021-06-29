<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\department;
use App\Models\File;
use App\Models\position;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //
    public function MainView(){
        $users = User::all();
        $departments = department::all();
        $positions = position::all();
        return view("index",compact("users","departments","positions"));
    }
    //
    public function FileView($id){
        $files = User::where("id",$id)->first()->files()->get();
        // var_dump($files);
        return view("files",compact("files"));
    }
}
