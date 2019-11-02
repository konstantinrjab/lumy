@extends('adminlte::page')

@section('title', 'Home Page')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h4>Home</h4>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
        </div>
    </div>
@endsection
