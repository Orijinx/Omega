<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use App\Models\position;
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
            return back()->with("status", "Успешно!");
        } else {
            return back()->with("status", "Неудачно!");
        }
    }
    //Удаление отедал
    public function DelDepartment(Request $req)
    {
        if (isset($req->id) && (Auth::user()->rights > 1)) {
            if (is_array($req->id)) {
                department::destroy($req->id);
            } else {
                department::findOrFail($req->id)->delete();
            }
            return back()->with("status", "Успешно!");
        } else {
            return back()->with("status", "Неудачно!");
        }
    }
    //Удаление отедал
    public function UpdDepartment(Request $req)
    {
        if (isset($req->id) && (Auth::user()->rights > 1)) {
            $dep = department::where("id", $req->id);
            if (isset($dep->name)) {
                $dep->name = $req->name;
                $dep->save();
                return back()->with("status", "Успешно!");
            } else {
                return back()->with("status", "Неудачно!");
            }
        } else {
            return back()->with("status", "Неудачно!");
        }
    }
    /////////////////////////////////////////////////////////////
    //Добавление должности
    public function AddPosition(Request $req)
    {
        $pos = new position();
        if (isset($req->name) && (Auth::user()->rights >= 1)) {
            $pos->name = $req->name;
            $pos->save();
            return back()->with("status", "Успешно!");
        } else {
            return back()->with("status", "Неудачно!");
        }
    }
    //Удаление отедал
    public function DelPosition(Request $req)
    {
        if (isset($req->id) && (Auth::user()->rights > 1)) {
            if (is_array($req->id)) {
                position::destroy($req->id);
            } else {
                position::findOrFail($req->id)->delete();
            }
            return back()->with("status", "Успешно!");
        } else {
            return back()->with("status", "Неудачно!");
        }
    }
    //Удаление отедал
    public function UpdPosition(Request $req)
    {
        if (isset($req->id) && (Auth::user()->rights > 1)) {
            $pos = position::where("id", $req->id);
            if (isset($pos->name)) {
                $pos->name = $req->name;
                $pos->save();
                return back()->with("status", "Успешно!");
            } else {
                return back()->with("status", "Неудачно!");
            }
        } else {
            return back()->with("status", "Неудачно!");
        }
    }
}
