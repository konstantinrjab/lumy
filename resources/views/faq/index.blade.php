@extends('adminlte::page')

@section('title', 'Faqs')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="datatables">
                        <thead>
                        <tr>
                            <th>Alias</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faqs as $faq)
                            <tr>
                                <td>{{ $faq->alias }}</td>
                                <td>{{ Illuminate\Support\Str::limit($faq->title, 30) }}</td>
                                <td>{{ Illuminate\Support\Str::limit($faq->text, 50) }}</td>
                                <td>
                                    <a href="/faq/{{$faq->id}}"><i class="fas fa-eye"></i></a>
                                    <a href="/faq/{{$faq->id}}"><i class="fas fa-pen"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#confirm-delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('modals/delete_confirmation')
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.datatables').DataTable();
        });
    </script>
@endsection
