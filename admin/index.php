<?php
//改成自動加載
require_once("../includes/init.php");
   
Auth::requireLogin();

   $conn = require_once('../includes/db.php');


   $paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn, true));

   //取得所有文章
   $articles = Article::getPage($conn, $paginator->limit,  $paginator->offset, false);
?>
<?php require_once('../includes/header.php'); ?>
       
    <h2>管理者介面</h2> 

    <a href="new-article.php">新增文章</a>
    
        <!-- 加入判斷如果數組是空的不能顯示 -->
        <?php if(empty($articles)): ?>
            No articles found.
        <?php else: ?>
        
            <table class="table">
                <thead>
                    <th>標題</th>
                    <th>發佈日期</th>
                </thead>
                <tbody>
                    <?php foreach($articles as $article): ?>
                        <tr>
                            <td>
                                <a <?= "href=article.php?id={$article['id']}"; ?>><?= htmlspecialchars($article['title']) ?></a>
                            </td>
                            <td>
                                <?php if ($article['published_at']):?>
                                    <time><?= $article['published_at']?></time>
                                <?php else: ?>
                                    <em>尚未發佈</em>
                                    <button class="publish" data-id="<?= $article['id']?>">發佈</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

<?php require_once('../includes/pagination.php'); ?>
        <?php endif; ?>

<?php require_once('../includes/footer.php'); ?>