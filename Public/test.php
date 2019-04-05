<?php
//session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
////session_unset();
//echo '<pre>';
//
//
//var_dump($_SESSION);
//
//?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="/test" method="post">
    <input type="hidden" name="csrf" value="">
    <button type="submit">Click</button>
</form>


<script>

    checkAjax();

    function checkAjax() {
        fetch("/test",
            {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({foo: 'some foo value'})
            })
            .then(function (res) {
                console.log(res)
            })
            .catch(function (res) {
                console.log(res)
            })
    }
</script>
</body>
</html>
