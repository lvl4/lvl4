<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') - lvl4.org</title>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/kohaibu.css">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
        <script src="/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" href="/select2-4.0.3/dist/css/select2.min.css">
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        @yield('css')
    </head>
    <body>
        @include('partials.navbar')
        @yield('content')
        @yield('extra')

        @yield('scripts')
        <script src="/select2-4.0.3/dist/js/select2.min.js"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>
        <script>
            function travel(link){
                window.location.href = link;
            }
        </script>
    </body>
</html>