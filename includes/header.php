<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>
   
    <header>
        <h1>My Blog</h1>
    </header>
 
    <nav>
        <ul>
            <li><a href="/PHP-beginger/">首頁</a></li>
            <?php if (Auth::isLoggedIn()) :?>
                <li><a href="/PHP-beginger/admin/">管理者介面</a></li>
                <li><a href="/PHP-beginger/logout.php">登出</a></li>
            <?php else:?>
                <li><a href="/PHP-beginger/login.php">登入</a></li>
            <?php endif;?>

            <li><a href="/PHP-beginger/contact.php">聯絡我們</a></li>
        </ul>

    </nav>

    <main>