<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <h3><?= $title ?></h3>
    <ul>
        <?php
        foreach ($arr as $ar) {
            echo "<li>$ar</li>";
    }
        ?>
    </ul>
</head>
<body>
<h1>this is welcome view file</h1>
</body>
</html>
