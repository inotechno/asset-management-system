@include('layouts.partials.auth-head')

<body>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            @yield('content')
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    @include('layouts.partials.auth-plugin')

</body>

</html>
