@extends('layouts.header-footer')

@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Файлы</th>
                <th scope="col">email</th>
                <th scope="col">Departments</th>
                <th scope="col">Position</th>
                <th scope="col">Rights</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row"><a href="files/{{$user->id}}">#{{ $user->id }}</a></th>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->departments()->get() as $department)
                            {{ $department->name }}
                            <br>
                        @endforeach
                    </td>
                    @if (isset($user->position()->first()->name))
                        <td>{{ $user->position()->first()->name }}</td>
                    @else
                        <td>НЕТ</td>
                    @endif

                    <td>@switch($user->rights)
                            @case(1)
                                Менеджер
                            @break
                            @case(2)
                                Администратор
                            @break
                            @default
                                Пользователь

                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <form action="/loadfile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlFile1">Загрузка файлов</label>
            <input name="file" type="file" class="form-control-file" id="exampleFormControlFile1">
       <button class="btn btn-primary" type="submit">Загрузить</button>
        </div>
    </form>
    <hr>

    @if (Auth::check())


        @if (Auth::user()->rights > 0)

            {{-- CUD section --}}
            <h2 class="text-center my-5">Панель управления</h2>
            @if (Session::has('err')))
                <h4 style="color: red;">{{ Session::get('err') }}</h4>

            @endif
            @if (Session::has('suc')))
                <h4 style="color: green;">{{ Session::get('suc') }}</h4>

            @endif
            <div class="container my-5">
                {{-- DELETE USER FORM --}}
                @if (Auth::user()->rights > 1)
                    <form action="/deluser" method="POST">
                        @csrf
                        <h3>Удалить пользователя</h3>
                        <div class="input-group mb-3">
                            <select name="id" class="form-select" id="deletgroup">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary" type="submit">Удалить</button>
                        </div>
                    </form>
                @endif
                {{-- ADD USER FORM --}}
                <form action="/adduser" method="POST">
                    @csrf
                    <h3>Добавить пользователя</h3>
                    {{-- <div class="input-group mb-3">
                        <select class="form-select" id="deletgroup">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        <input required name="email" type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Имя</span>
                        <input required name="name" type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Пароль</span>
                        <input required name="password" type="password" class="form-control"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Подтверждение пароля</span>
                        <input name="password_confirm" type="password" class="form-control"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                        <select required name="dep_id[]" class="form-select" multiple aria-label="multiple select example">
                            @foreach ($departments as $dep)
                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Должность</span>

                        <select required name="pos_id" class="form-select">

                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Роль</span>

                        <select required name="rights" class="form-select">
                            <option value="0">Пользователь</option>
                            <option value="1">Менеджер</option>
                            <option value="2">Администратор</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                </form>

                {{-- UPDATE USER FORM --}}
                <form action="/upduser" method="POST">
                    @csrf
                    <h3>Изменить пользователя</h3>
                    <div class="input-group mb-3">
                        <select name="id" class="form-select" id="deletgroup">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        <input name="email" type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Имя</span>
                        <input name="name" type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Пароль</span>
                        <input name="password" type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                        <select name="dep_id[]" class="form-select" multiple aria-label="multiple select example">
                            @foreach ($departments as $dep)
                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Должность</span>

                        <select name="pos_id" class="form-select">

                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Роль</span>

                        <select name="rights" class="form-select">
                            <option value="0">Пользователь</option>
                            <option value="1">Менеджер</option>
                            <option value="2">Администратор</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-secondary" type="submit">Обновить</button>
                </form>
                <hr>
                {{-- ADD DEPARTMENT FORM --}}

                <form action="/adddepartment" method="POST">
                    @csrf
                    <h3>Добавление отдела</h3>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Название</span>
                        <input required type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" name="name">
                    </div>
                    <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                </form>

                @if (Auth::user()->rights > 1)

                    {{-- DELETE DEPARTMENT FORM --}}
                    <form action="/deldepartment" method="post">
                        @csrf
                        <h3>Удаление отдела</h3>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                            <select name="id[]" class="form-select" multiple aria-label="multiple select example">
                                @foreach ($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary" type="submit">Удалить</button>
                        </div>
                    </form>
                @endif
                {{-- UPDATE DEPARTMENT FORM --}}
                <form action="/upddepartment" method="post">
                    @csrf
                    <h3>Изменение отдела</h3>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                        <select required name="id" class="form-select" aria-label="select example">
                            @foreach ($departments as $dep)
                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group input-group-sm my-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Название</span>
                            <input required type="text" name="name" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <button class="btn btn-outline-secondary" type="submit">Изменить</button>
                    </div>
                </form>
                <hr>



                {{-- ADD POSITION FORM --}}

                <form action="/addposition" method="POST">
                    @csrf
                    <h3>Добавление должности</h3>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Название</span>
                        <input required type="text" name="name" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                </form>

                @if (Auth::user()->rights > 1)

                    {{-- DELETE POSITION FORM --}}
                    <form action="/delposition" method="post">
                        @csrf
                        <h3>Удаление должности</h3>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                            <select name="id[]" class="form-select" multiple aria-label="multiple select example">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary" type="submit">Удалить</button>
                        </div>
                    </form>
                @endif
                {{-- UPDATE POSITION FORM --}}
                <form action="" method="post">
                    @csrf
                    <h3>Изменение должности</h3>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                        <select required name="id" class="form-select" aria-label="select example">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group input-group-sm my-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Название</span>
                            <input required type="text" name="name" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <button class="btn btn-outline-secondary" type="submit">Изменить</button>
                    </div>
                </form>
            </div>
        @endif
    @endif

@endsection
