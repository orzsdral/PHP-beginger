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
            FROM article
            WHERE id = ' . $_GET['id'];

    $results = mysqli_query($conn, $sql);
    //判斷$result===false,代表SQL語法有誤
    if($results === false){
        //顯示錯誤訊息
        echo mysqli_error($conn);
        exit;
    }
    // $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
    //改由mysqli_fetch_assoc()來取得資料,從結果集中取得一行作為關聯數組，若無抓回東西會回傳NULL
    $articles = mysqli_fetch_assoc($results);


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
        <!-- 因只有一行資料，故不需要foreach去結果集中撈資料 去除了ol/li/foreach-->
        <!-- 加入判斷如果數組是空的不能顯示///因改使用mysqli_fetch_assoc()若回傳無值會顯null因此更換判斷條件 -->
        <?php if($articles === null): ?>
            No articles found.
        <?php else: ?>
                    <h2><?php echo $articles['title']; ?></h2>
                    <p><?php echo $articles['content']; ?></p>
        <?php endif; ?>
    </main>
</body>
</html>