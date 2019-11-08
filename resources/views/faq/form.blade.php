@extends('adminlte::page')

@section('title', 'Create')

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="/faqs/{{ $faq->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input id="alias" class="form-control" type="text" name="alias" value="{!! isset($faq) ? $faq->alias : '' !!}">
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" class="form-control" type="text" name="title" value="{!! isset($faq) ? $faq->title : '' !!}">
                </div>

                <div id="editor">
                    <label for="js-froalaEditor">Text</label>
                    <textarea id="js-froalaEditor" name="text">
                        {!! isset($faq) ? $faq->text : '' !!}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>

@endsection

@push('css')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/css/froala_editor.pkgd.min.css' rel='stylesheet'
          type='text/css'/>
@endpush

@push('js')
    <script type='text/javascript'
            src='https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/js/froala_editor.pkgd.min.js'></script>
    <script>
        new FroalaEditor('#js-froalaEditor')
    </script>
@endpush
