<?php
    $db_host = 'localhost';
    $db_user = 'Anthony';
    $db_password = 'LIN';
    $db_name = 'cms';

    //建立與資料庫連線
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    //判斷$conn是否有物件回傳來，"有"就會值就為True;"沒有"就會回傳False，在用!來取反義
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }           
    //抓取資料庫的資料
    $sql = 'SELECT * 
            FROM article';

    $results = mysqli_query($conn, $sql);
    //判斷$result===false,代表SQL語法有誤
    if($results === false){
        //顯示錯誤訊息
        echo mysqli_error($conn);
        exit;
    }
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>
    <!-- 標題 -->
    <header>
        <h1>My Blog</h1>
    </header>
    <!-- 讀取出陣列鍵和值 -->
    <main>
        <ol>
        <!-- 加入判斷如果數組是空的不能顯示 -->
        <?php if(empty($articles)): ?>
            No articles found.
        <?php else: ?>
            <?php foreach($articles as $article): ?>
                <li>
                    <h2><a <?= "href=article.php?id={$article['id']}"; ?>><?php echo $article['title']; ?></a></h2>
                    <p><?php echo $article['content']; ?></p>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        </ol>
    </main>
</body>
</html>