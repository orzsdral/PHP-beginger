<?php
//改成自動加載
require_once("includes/init.php");
   
   $conn = require_once('includes/db.php');
    
     //取得所有文章
     $articles = Article::getPage($conn, 4, 0);
  
   
?>
<?php require_once('includes/header.php'); ?>

        
        <!-- 加入判斷如果數組是空的不能顯示 -->
        <?php if(empty($articles)): ?>
            No articles found.
        <?php else: ?>
            <ol>
                <?php foreach($articles as $article): ?>
                    
                    <li>
                        <h2><a <?= "href=article.php?id={$article['id']}"; ?>><?= htmlspecialchars($article['title']) ?></a></h2>
                        <p><?= htmlspecialchars($article['content']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
        


<?php require_once('includes/footer.php'); ?>