@extends('adminlte::page')

@section('title', $faq->title)

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <a href="/faqs/{{$faq->id}}/edit">Edit</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Property</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Alias</td>
                            <td>{{ $faq->alias }}</td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $faq->title }}</td>
                        <tr>
                            <td>Text</td>
                            <td>{!! $faq->text !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
