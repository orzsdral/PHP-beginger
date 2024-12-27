<?php
    //引入db.php
    require_once('includes/db.php');       
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
<?php require_once('includes/header.php'); ?>

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


<?php require_once('includes/footer.php'); ?>