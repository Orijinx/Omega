@extends('layouts.header-footer')
@section('body')


    <div class="container inline">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" id="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" id="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            <!-- Name -->
            {{-- <div>

                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div> --}}
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password"  type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password Confirm</label>
                <input name="password_confirmation"  type="password" class="form-control" id="exampleInputPassword1" placeholder="Password confirm">
              </div>
            <!-- Email Address -->
            


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
@endsection
