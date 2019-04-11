<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf() }}">
    <link href="/css/app/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/app/roboto.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/app/material-icons.min.css') }}">
    <!--    <link rel="stylesheet" href="/css/app/bootstrap.min.css">-->
    <link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ url('/js/app/vue.js') }}"></script>
    <script src="{{url('/js/app/axios.min.js') }}"></script>
    <script src="{{url('/js/app/vuetify.js') }}"></script>
</head>
<body>
<script>
    const csrf_token = document.head.querySelector("[name~=csrf-token][content]").content;
    axios.defaults.headers.common['X-CSRF-Token'] = csrf_token;     //set csrf token
    // axios.defaults.headers.common['Content-Type'] = 'application/json';   //set type of request
    // axios.defaults.headers.common['Accept'] = 'application/json';   //set type of request
</script>
<div id="app">
    @yield('content')
</div>


@yield('script')
</body>
</html>
