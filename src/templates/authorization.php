<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <title>authorization</title>
    <link rel="stylesheet" href="/src/templates/css/main.css">
</head>
<body>
<form action="/authorize" method="post" enctype="multipart/form-data">
    <label for="login">Login</label>
    <input id="login" name="login" type="text" placeholder="input login">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="input password">
    <button>Authorize</button>
    <p>
        <a href="/registration">registration</a>
    </p>
</form>
</body>
</html>