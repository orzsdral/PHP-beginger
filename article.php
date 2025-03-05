<?php


//改成自動加載
require_once("includes/init.php");
   
    $conn = require_once('includes/db.php');

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        //$articles = getArticle($conn, $_GET['id']);
        //改用類別函數
        $articles = Article::getWithCategories($conn, $_GET['id']);
    }else{
        //若沒有id值或id值不是數字則顯示null
        $articles = null;
    }

?>
<?php require_once('includes/header.php'); ?>


    <main>
        <!-- 因只有一行資料，故不需要foreach去結果集中撈資料 去除了ol/li/foreach-->
        <!-- 加入判斷如果數組是空的不能顯示///因改使用mysqli_fetch_assoc()若回傳無值會顯null因此更換判斷條件 -->
        <?php if($articles): ?>
                <article>
                    <h2><?= htmlspecialchars($articles[0]['title']) ?></h2>

                    <?php if ($articles[0]['category_name']): ?>
                        <p>Categories: 
                            <?php foreach($articles as $a): ?>
                                <?= htmlspecialchars($a['category_name']) ?>
                            <?php endforeach; ?>
                        </p>
                    <?php endif;?>

                    <?php if ($articles[0]['image_file']): ?>
                        <img src="uploads/<?= $articles[0]['image_file'] ?>">
                    <?php endif;?>

                    <p><?= htmlspecialchars($articles[0]['content']) ?></p>
                </article>
      
               
        <?php else: ?>
                No articles found.
        <?php endif; ?>

<?php require_once('includes/footer.php'); ?>