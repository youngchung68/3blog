@extends('layouts.master')

@section('title',' | Forget my Password')


@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['method'=>'POST', 'url'=>'password/email']) !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::email('email',null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Reset Password',['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>


@endsection