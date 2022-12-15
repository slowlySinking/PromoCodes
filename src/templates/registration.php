<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>registration</title>
    <link rel="stylesheet" href="/src/templates/css/main.css">
</head>
<body>
<form action="/user" method="POST" enctype="multipart/form-data">
    <label for="login">Login</label>
    <input id="login" name="login" type="text" placeholder="input login">
    <label for="email">Email</label>
    <input id="email" name="email" type="email" placeholder="input email">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="input password">
    <label for="password_confirm">Password</label>
    <input id="password_confirm" name="password_confirm" type="password" placeholder="confirm password">
    <button>Register</button>
    <p>
        <a href="/auth/login">authorization</a>
    </p>
</form>
</body>
</html>