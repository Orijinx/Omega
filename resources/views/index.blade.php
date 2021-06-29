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
@endsection
