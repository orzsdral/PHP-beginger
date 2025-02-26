<?php
//改成自動加載
require_once("includes/init.php");
   
   $conn = require_once('includes/db.php');
   
    //判斷是否有page的參數
    /*
    1.一般寫法
    if (isset($_GET['page'])) {
        //建立分頁物件
        $paginator = new Paginator($_GET['page'], 4); 
    }else{
    //若無則預設為第一頁
        $paginator = new Paginator(1, 4);
    }*/

    //2.三元寫法
    //$paginator = new Paginator(isset($_GET['page']) ? $_GET['page'] : 1, 4);

    //3.Null coalescing operator寫法
    $paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($conn));

     //取得所有文章
     $articles = Article::getPage($conn, $paginator->limit,  $paginator->offset);
  
   
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



<?php require_once('includes/pagination.php'); ?>
        <?php endif; ?>
        


<?php require_once('includes/footer.php'); ?>