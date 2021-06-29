<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use Illuminate\Support\Facades\Auth;

class CrudController extends Controller
{
    //Добавление отедал
    public function AddDepartment(Request $req)
    {
        $dep = new department();
        if (isset($req->name) && (Auth::user()->rights >= 1)) {
            $dep->name = $req->name;
            $dep->save();
            return back()->with("suc", "Успешно!");
        } else {
            return back()->with("err", "Неудачно!");
        }
    }
    //Удаление отедал
    public function DelDepartment(Request $req)
    {

        if (isset($req->id) && (Auth::user()->rights > 1)) {
            var_dump($req->id);
            if (is_array($req->id)) {
                department::destroy($req->id);
            } else {
                department::findOrFail($req->id)->delete();
            }
            return back()->with("suc", "Успешно!");
        } else {
            return back()->with("err", "Неудачно!");
        }
    }
    //Удаление отедал
    public function UpdDepartment(Request $req)
    {
        if (isset($req->id) && (Auth::user()->rights >= 1)) {
        var_dump($req->id);

            $dep = department::where("id", $req->id)->first();
            if (isset($dep->name)) {
                $dep->name = $req->name;
                $dep->save();
                return back()->with("suc", "Успешно!");
            } else {
                return back()->with("err", "Неудачно!");
            }
        } else {
            return back()->with("err", "Неудачно!");
        }
    }
}
