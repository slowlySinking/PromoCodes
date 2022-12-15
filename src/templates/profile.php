<?php

/** @var $data */

/** @var \App\Entity\User $user */
$user = $data['user'];

?>

<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <title>profile</title>
    <link rel="stylesheet" href="/src/templates/css/main.css">
</head>
<body>
    <div>
        <h1>Welcome <?= $user->getLogin();?>!</h1>
        <a href="/promocode">get promo code</a>
        <a href="/auth/logout">logout</a>
    </div>
</body>
</html>
