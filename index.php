<?php
//改成自動加載
require_once("includes/init.php");
   
   $conn = require_once('includes/db.php');
    //取得所有文章
    $articles = Article::getAll($conn);
?>
<?php require_once('includes/header.php'); ?>
<!-- //判斷是否登入 -->
<?php if (Auth::isLoggedIn()): ?>
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