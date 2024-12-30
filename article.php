<?php
//引入db.php/article.php
   require_once('includes/db.php');
   require_once('includes/article.php');
    //建立與資料庫的連線
    $conn = getDB();

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        $articles = getArticle($conn, $_GET['id']);
    }else{
        //若沒有id值或id值不是數字則顯示null
        $articles = null;
    }
?>
<?php require_once('includes/header.php'); ?>


    <main>
        <!-- 因只有一行資料，故不需要foreach去結果集中撈資料 去除了ol/li/foreach-->
        <!-- 加入判斷如果數組是空的不能顯示///因改使用mysqli_fetch_assoc()若回傳無值會顯null因此更換判斷條件 -->
        <?php if($articles === null): ?>
            No articles found.
        <?php else: ?>
                <article>
                    <h2><?= htmlspecialchars($articles['title']) ?></h2>
                    <p><?= htmlspecialchars($articles['content']) ?></p>
                </article>

                <a href="edit-article.php?id=<?= $articles['id'];?>">編輯文章</a>
        <?php endif; ?>

<?php require_once('includes/footer.php'); ?>