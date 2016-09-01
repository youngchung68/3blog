@extends('layouts.master')


@section('title','| Edit Comment' )

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Edit Comment</h1>

            {!! Form::open(['method'=>'PUT', 'route'=>['comments.update', $comment->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name',$comment->name, ['class'=>'form-control','disabled'=>'']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email',$comment->email, ['class'=>'form-control','disabled'=>'']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('comment', 'Comment:') !!}
                {!! Form::textarea('comment',$comment->comment, ['class'=>'form-control','rows'=>'5']) !!}
            </div>

                <div class="form-group">
                    {!! Form::submit('Update Comment',['class'=>'btn btn-success btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endsection