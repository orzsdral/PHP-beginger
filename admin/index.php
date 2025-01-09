<?php
//改成自動加載
require_once("../includes/init.php");
   
Auth::requireLogin();

   $conn = require_once('../includes/db.php');
    //取得所有文章
    $articles = Article::getAll($conn);
?>
<?php require_once('../includes/header.php'); ?>
<!-- //判斷是否登入 -->
<?php if (Auth::isLoggedIn()): ?>
    <p>你已登入，要<a href="logout.php">登出</a>嗎?</p>
<!-- //登入才能看到移動來判斷裡面 -->
    <a href="new-article.php">新增文章</a>
<?php else: ?>
    <p>你未<a href="login.php">登入</a>?!</p>
<?php endif; ?>
       
    <h2>管理者介面</h2> 
        <!-- 加入判斷如果數組是空的不能顯示 -->
        <?php if(empty($articles)): ?>
            No articles found.
        <?php else: ?>
        
            <table>
                <thead>
                    <th>標題</th>
                </thead>
                <tbody>
                    <?php foreach($articles as $article): ?>
                        <tr>
                            <td>
                                <a <?= "href=article.php?id={$article['id']}"; ?>><?= htmlspecialchars($article['title']) ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

<?php require_once('../includes/footer.php'); ?>