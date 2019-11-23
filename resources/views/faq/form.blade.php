@extends('adminlte::page')

@section('title', 'Create')

@section('content')

    <div class="card">
        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/faqs/{{ isset($faq) ? $faq->id : '' }}" method="post">
                {{ csrf_field() }}
                @if (isset($faq))
                    {{ method_field('PUT') }}
                @endif
                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input id="alias" class="form-control" type="text" name="alias"
                           value="{!! isset($faq) ? $faq->alias :  old('alias') !!}">
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" class="form-control" type="text" name="title"
                           value="{!! isset($faq) ? $faq->title : old('title') !!}">
                </div>

                <div>
                    <label for="js-editor">Text</label>
                    <textarea id="js-editor" name="text">
                        {!! isset($faq) ? $faq->text : old('text') !!}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>

@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endpush

@push('js')
    <script
        src="https://cdn.tiny.cloud/1/j01lcj2td4pdf0ffk30licnfs7mty9bp99enn54iq1hz3h0q/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: '#js-editor'});</script>
@endpush
