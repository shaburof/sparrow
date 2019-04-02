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
<form action="/" method="post">
    <input type="hidden" name="fooNameByPost" value="fooValueByPost2">
    <button>Click</button>
</form>
<script>
    fetch('/', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({paramOne: 'value param one'})
        }
    ).then(res => console.log(res)).catch(err => console.log(err));
</script>
</body>
</html>
