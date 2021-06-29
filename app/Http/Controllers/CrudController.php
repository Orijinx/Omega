<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use App\Models\position;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\department_conn;

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
    /////////////////////////////////////////////////////////////
    //Добавление должности
    public function AddPosition(Request $req)
    {
        $pos = new position();
        if (isset($req->name) && (Auth::user()->rights >= 1)) {
            $pos->name = $req->name;
            $pos->save();
            return back()->with("suc", "Успешно!");
        } else {
            return back()->with("err", "Неудачно!");
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
            return back()->with("suc", "Успешно!");
        } else {
            return back()->with("err", "Неудачно!");
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
                return back()->with("suc", "Успешно!");
            } else {
                return back()->with("err", "Неудачно!");
            }
        } else {
            return back()->with("err", "Неудачно!");
        }
    }
    ////////////////////////////////////////////////////////////////////
    public function AddUser(Request $req)
    {
        if ((Auth::user()->rights >= 1)) {
            $user = new User();
            $user->name = $req->name;
            $user->password = Hash::make($req->password);

            if (User::where("email", $req->email)->exists()) {
                return back()->with("err", "Неудачно!");
            }
            $user->email = $req->email;
            if (position::where("id", $req->pos_id)->exists()) {
                $user->position_id = $req->pos_id;
            } else {
                return back()->with("err", "Неудачно!");
            }
            $user->rights = $req->rights;
            $user->save();
            foreach ($req->dep_id as $dep) {
                $depart = new department_conn();
                $depart->user_id = $user->id;
                if (department::where("id", $dep)->exists()) {
                    $depart->dep_id = $dep;
                } else {
                    $user->delete();
                    return back()->with("err", "Неудачно!");
                }
                $depart->save();
            }
            return back()->with("suc", "Успешно!");
        }
    }
    public function UpdUser(Request $req)
    {
        if ((Auth::user()->rights >= 1) && (User::where("id", $req->id)->exists())) {
            $user = User::where("id", $req->id)->first();
            if (isset($req->name)) {
                $user->name = $req->name;
            }
            if (isset($req->password)) {
                $user->password = Hash::make($req->password);
            }

            if (isset($req->email)) {
                $user->email = $req->email;
            }

            if (isset($req->pos_id)) {
                if (position::where("id", $req->pos_id)->exists()) {

                    $user->position_id = $req->pos_id;
                } else {
                    return back()->with("err", "Неудачно!");
                }
            }

            if (isset($req->rihts)) {
                $user->rights = $req->rights;
            }
            $user->save();

            if (isset($req->dep_id)) {
                foreach ($req->dep_id as $dep) {
                    $depart = new department_conn();
                    $depart->user_id = $user->id;
                    if (department::where("id", $dep)->exists()) {
                        $depart->dep_id = $dep;
                    } else {
                        $user->delete();
                        return back()->with("err", "Неудачно!");
                    }
                    $depart->save();
                }
            }
            return back()->with("suc", "Успешно!");
        }
    }
    public function DelUser(Request $req)
    {
        if ((Auth::user()->id != $req->id) && (Auth::user()->rights > 1)) {
            User::destroy($req->id);
            return back()->with("suc", "Успешно!");
        } else {
            return back()->with("err", "Неудачно!");
        }
    }
}
