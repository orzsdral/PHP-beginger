<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/PHP-beginger/css/styles.css">
    <link rel="stylesheet" href="/PHP-beginger/css/jquery.datetimepicker.min.css">
</head>
<body>
    <div class="container">

    <header>
        <h1>My Blog</h1>
    </header>
 
    <nav>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="/PHP-beginger/">首頁</a></li>
            <?php if (Auth::isLoggedIn()) :?>
                <li class="nav-item"><a class="nav-link" href="/PHP-beginger/admin/">管理者介面</a></li>
                <li class="nav-item"><a class="nav-link" href="/PHP-beginger/logout.php">登出</a></li>
            <?php else:?>
                <li class="nav-item"><a class="nav-link" href="/PHP-beginger/login.php">登入</a></li>
            <?php endif;?>

            <li class="nav-item"><a class="nav-link" href="/PHP-beginger/contact.php">聯絡我們</a></li>
        </ul>

    </nav>

    <main>