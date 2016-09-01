<!DOCTYPE html>
<html >
<head>
    @include('includes.header')
</head>
<body>

    @include('includes.nav')

    <div class="container">

        @include('includes.messages')

        {{--{{ Auth::check() ? "Logged In":"Logged Out" }}--}}



        @yield('content')

        @include('includes.footer')

    </div>


    @include('includes.javascript')

    @yield('scripts')

</body>

</html>
