@extends('layouts.master')

@section('title',' | Contact')

@section('content')



    <div class="row">
        <div class="col-md-12 ">
            <h1>Contact Me</h1>
            <hr>
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="text" name="email"  class="form-control">
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea  name="message" id="message" class="form-control">Type your message here...
                    </textarea>
                </div>

                <input class="btn btn-primary" type="submit" value="Send Message">
            </form>
        </div>





    </div>

@endsection