<?php
//$string = shell_exec('php ../sparrow.php create:controller abc.newController');
//var_dump($string);


$controllersRootPath = '/var/www/sparrow/Start/../App/Controllers/';
$path = 'abc/def/newController';

$fullControllerPath="$controllersRootPath$path.php";
if (file_exists($fullControllerPath)) {
    echo 'controller exists';
    die();
}

$explodePath = explode('/', $path);
$controllerName = array_pop($explodePath) . '.php';
$path = implode($explodePath, '/') . '/';

@mkdir($controllersRootPath . $path, 0777, true);

$myfile = fopen($controllersRootPath . $path . $controllerName, "w") or die("Unable to open file!");
$txt = "Mickey Mouse\n";
$txt = "Minnie Mouse\n";
fwrite($myfile, $txt);
fclose($myfile);
die();
?>

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
