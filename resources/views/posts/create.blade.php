@extends('layouts.master')

@section('title',' | Create New Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            plugins: "link code",
            menubar: false
        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New Post</h1>
            <hr>

                {{--{!! Form::open(['method'=>'POST', 'action'=>'PostsController@store']) !!}--}}
            {!! Form::open(['route'=>'posts.store', 'data-parsley-validate'=>'','files'=>true]) !!}
                <div class="form-group">
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title',null, ['class'=>'form-control','maxlength' => '255']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('slug', 'Slug:') }}
                    {{ Form::text('slug',null, ['class'=>'form-control','minlength'=>'5','maxlength' => '255']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('category_id', 'Category:') }}
                    {{ Form::select('category_id', [''=>'Choose Categories'] + $categories , null, ['class'=>'form-control' ]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('tags', 'Tags:') }}
                    {{ Form::select('tags[]',  $tags , null, ['class'=>'form-control select2-multi','multiple'=>'multiple']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('featured_image', 'Upload Featured Image:') }}
                    {{ Form::file('featured_image') }}
                </div>


                <div class="form-group">
                    {{ Form::label('body', 'Post Body:') }}
                    {{ Form::textarea('body',null, ['class'=>'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Create Post',['class'=>'btn btn-success']) }}
                </div>
            {!! Form::close() !!}

        </div>
    </div>


@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();

    </script>

@endsection