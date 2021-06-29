@extends('layouts.header-footer')

@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">File Path</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <th scope="row">#{{ $file->id }}</th>
                    <td><a href="{{asset($file->file_path)}}">{{ $file->file_path }}</a></td>




                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
