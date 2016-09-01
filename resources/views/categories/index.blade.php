@extends('layouts.master')

@section('title',' | All Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
             <table class="table">
                 <thead>
                   <tr>
                     <th>#</th>
                     <th>Name</th>
                   </tr>
                 </thead>
                 <tbody>
                 @foreach($categories as $category)
                   <tr>
                     <th>{{ $category->id }}</th>
                     <td>{{ $category->name }}</td>
                   </tr>
                 @endforeach
                 </tbody>
              </table>

        </div>
        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['method'=>'POST', 'route'=>'categories.store']) !!}
                <h2>New Category</h2>
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name',null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create New Category',['class'=>'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>




@endsection