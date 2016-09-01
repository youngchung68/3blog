@extends('layouts.master')


@section('title','| Delete Comment' )

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Delete This Comment?</h1>
            <p>
                <strong>Name:</strong> {{ $comment->name }}<br>
                <strong>Email:</strong> {{ $comment->email }}<br>
                <strong>Comment:</strong> {{ $comment->comment }}
            </p>

            {!! Form::open(['method'=>'DELETE', 'route'=>['comments.destroy', $comment->id]]) !!}

                <div class="form-group">
                    {!! Form::submit('Yes Delete This Comment ',['class'=>'btn btn-danger btn-block btn-lg']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection