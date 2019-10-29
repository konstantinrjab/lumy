@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" method="post">
                            {!! csrf_field() !!}

                            @if (count($errors) > 0)
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="form-label-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" value="{{ old('email') }}">
                            </div>

                            <div class="form-label-group mt-2">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                            </div>

                            <button class="btn btn-primary btn-block mt-3" type="submit">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
