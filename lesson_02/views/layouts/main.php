<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/lesson_02/public/css/main.css">
</head>
<body>
    <ul class="menu">
        <li><a href="?contr=user&action=users">Users</a></li>
        <li><a href="?contr=user&action=user&id=1">User</a></li>
        <li><a href="?contr=product&action=products">Products</a></li>
        <li><a href="?contr=product&action=product&id=1">Product</a></li>
    </ul>
    <div class="content"><?= $content ?></div>

    <script src="/lesson_02/public/scripts/main.js"></script>
</body>
</html>