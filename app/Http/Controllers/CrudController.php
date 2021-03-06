<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use App\Models\position;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\department_conn;
use App\Models\File;

class CrudController extends Controller
{
    //Добавление отедал
    public function AddDepartment(Request $req)
    {
        $dep = new department();
        if (isset($req->name) && (Auth::user()->rights >= 1)) { //Проверка прав и взодящего запроса
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

        if (isset($req->id) && (Auth::user()->rights > 1)) { //Проверка прав и взодящего запроса
            var_dump($req->id);
            if (is_array($req->id)) {
                department::destroy($req->id); //удаление множества записей
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
        if (isset($req->id) && (Auth::user()->rights >= 1)) { //Проверка прав и взодящего запроса

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
        if (isset($req->name) && (Auth::user()->rights >= 1)) { //Проверка прав и взодящего запроса
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
        if (isset($req->id) && (Auth::user()->rights > 1)) { //Проверка прав и взодящего запроса
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
        if (isset($req->id) && (Auth::user()->rights >= 1)) { //Проверка прав и взодящего запроса
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
        if ((Auth::user()->rights >= 1)) { //Проверка прав и взодящего запроса
            $user = new User();
            $user->name = $req->name;
            $user->password = Hash::make($req->password);

            if (User::where("email", $req->email)->exists()) { //Проверка нет ли существующего email
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
            // Создание записей в связующую таблицу отделов
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
        if ((Auth::user()->rights >= 1) && (User::where("id", $req->id)->exists())) { //Проверка прав и взодящего запроса
            $user = User::where("id", $req->id)->first();
            if (isset($req->name)) {//Проверка вхождения в запрос
                $user->name = $req->name;
            }
            if (isset($req->password)) {//Проверка вхождения в запрос
                $user->password = Hash::make($req->password);
            }

            if (isset($req->email)) {//Проверка вхождения в запрос
                $user->email = $req->email;
            }

            if (isset($req->pos_id)) {//Проверка вхождения в запрос
                if (position::where("id", $req->pos_id)->exists()) {

                    $user->position_id = $req->pos_id;
                } else {
                    return back()->with("err", "Неудачно!");
                }
            }

            if (isset($req->rihts)) {//Проверка вхождения в запрос
                $user->rights = $req->rights;
            }
            $user->save();

            if (isset($req->dep_id)) {//Проверка вхождения в запрос
                foreach ($req->dep_id as $dep) {
                    if (!department_conn::where("user_id", $user->id)->where("dep_id", $dep)->exists()) {
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
            }
            return back()->with("suc", "Успешно!");
        }
    }
    public function DelUser(Request $req)
    {
        if ((Auth::user()->id != $req->id) && (Auth::user()->rights > 1)) { //Проверка прав и взодящего запроса
            User::destroy($req->id);
            return back()->with("suc", "Успешно!");
        } else {
            return back()->with("err", "Неудачно!");
        }
    }
    /////////////////////////////////////////////////////////////////////////////////
    public function LoadFile(Request $req)
    {
        if (Auth::check()) {
            $file = new File;

            if ($req->file()) {
                $fileName =  date('d-m-Y') . '_' . $req->file->getClientOriginalName(); //Генерация новго имени "ДАТА" + "ОРИГИНАЛЬНОЕ ИМЯ"
                $filePath = $req->file('file')->storeAs('uploads/' . Auth::user()->email, $fileName, 'public');//Загрузка файла в Storage
                // запись файла в БД
                $file->file_name = time() . '_' . $req->file->getClientOriginalName();
                $file->file_path = '/storage/' . $filePath;
                $file->user_id = Auth::user()->id;
                $file->save();

                return back()->with('suc', 'Усешно!');
            } else {
                return back()->with('err', 'Неудачно!');
            }
        }
    }
}
