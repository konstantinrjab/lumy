@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card card-login card-hidden mb-3">
        <div class="card-header card-header-primary text-center">
          <h4>Home</h4>
        </div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          You are logged in!
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
