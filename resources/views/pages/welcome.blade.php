@extends('layouts.master')

@section('title',' | Home')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome to My Blog!</h1>
                <p class="lead"> Thank You so much for visiting. This is my test web</p>
                <p><a href="" class="btn btn-primary" role="button">Popular Post</a></p>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8">

            @foreach($posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p> {{ str_limit(strip_tags($post->body), 250) }} </p>
                    {{--<a href="{{ route('pages.single', $post->id) }}" class="btn btn-primary">Read More</a>--}}
                    <a href="{{url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                </div>

                <hr>

            @endforeach


        </div>


        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>

    </div>

@endsection