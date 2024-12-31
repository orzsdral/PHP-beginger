<?php
require_once("classes/DB.php");
require_once('includes/auth.php');

session_start();
   
    //建立與資料庫的連線
    $db = new DB(); //創建DB物件實例
    $conn = $db->getConn();//使用物件方法
    
    //抓取資料庫的資料
    $sql = 'SELECT * 
            FROM article';

    $results = $conn->query($sql);
 //移除判斷錯誤，改用PDO內建可拋出異常在物件內
    $articles = $results->fetchALL(PDO::FETCH_ASSOC);
?>
<?php require_once('includes/header.php'); ?>
<!-- //判斷是否登入 -->
<?php if (isLoggedIn()): ?>
    <p>你已登入，要<a href="logout.php">登出</a>嗎?</p>
<!-- //登入才能看到移動來判斷裡面 -->
    <a href="new-article.php">新增文章</a>
<?php else: ?>
    <p>你未<a href="login.php">登入</a>?!</p>
<?php endif; ?>
       
        <ol>
        <!-- 加入判斷如果數組是空的不能顯示 -->
        <?php if(empty($articles)): ?>
            No articles found.
        <?php else: ?>
            <?php foreach($articles as $article): ?>
                <li>
                    <h2><a <?= "href=article.php?id={$article['id']}"; ?>><?= htmlspecialchars($article['title']) ?></a></h2>
                    <p><?= htmlspecialchars($article['content']) ?></p>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        </ol>


<?php require_once('includes/footer.php'); ?>