@extends('layouts.header-footer')

@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">email</th>
                <th scope="col">Departments</th>
                <th scope="col">Position</th>
                <th scope="col">Rights</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->departments()->get() as $department)
                            {{ $department->name }}
                            <br>
                        @endforeach
                    </td>
                    <td>{{ $user->position()->first()->name }}</td>
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
    {{-- CUD section --}}
    <h2 class="text-center my-5">Панель управления</h2>
    <div class="container my-5">
        {{-- DELETE FORM --}}
        <form action="">
            <h3>Удалить пользователя</h3>
            <div class="input-group mb-3">
                <select class="form-select" id="deletgroup">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-secondary" type="button">Удалить</button>
            </div>
        </form>
        <hr>
        {{-- ADD USER FORM --}}

        <form action="">
            <h3>Добавить пользователя</h3>
            <div class="input-group mb-3">
                <select class="form-select" id="deletgroup">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Пароль</span>
                <input type="password" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Подтверждение пароля</span>
                <input type="password" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                <select class="form-select" multiple aria-label="multiple select example">
                    @foreach ($departments as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Должность</span>

                <select class="form-select">

                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Роль</span>

                <select class="form-select">
                    <option value="0">Пользователь</option>
                    <option value="1">Менеджер</option>
                    <option value="2">Администратор</option>
                </select>
            </div>
            <button class="btn btn-outline-secondary" type="button">Добавить</button>
        </form>

        <hr>
        {{-- UPDATE FORM --}}

        <form action="">
            <h3>Изменить пользователя</h3>
            <div class="input-group mb-3">
                <select class="form-select" id="deletgroup">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Отдел</span>
                <select class="form-select" multiple aria-label="multiple select example">
                    @foreach ($departments as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Должность</span>

                <select class="form-select">

                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Роль</span>

                <select class="form-select">
                    <option value="0">Пользователь</option>
                    <option value="1">Менеджер</option>
                    <option value="2">Администратор</option>
                </select>
            </div>
            <button class="btn btn-outline-secondary" type="button">Обновить</button>
        </form>
    </div>
@endsection
