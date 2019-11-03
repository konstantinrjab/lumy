@extends('adminlte::page')

@section('title', 'Home Page')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <table id="table_id" class="table table-bordered">
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
                        <td>{{ $faq->text }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

