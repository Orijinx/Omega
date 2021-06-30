@extends('layouts.header-footer')
@section('body')

    <div class="container">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" id="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>

            <!-- Remember Me -->
            <div class="form-check">
                <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>

            <div class="flex items-center justify-end mt-4">


                <button class="btn btn-primary">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
@endsection
