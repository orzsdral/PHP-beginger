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

        if ($articles === null){
          die("文章未發現");
        }
        //取得文章資訊
        $title = $articles['title'];
        $content = $articles['content'];
        $published_at = $articles['published_at'];
      
    }else{
        //若沒有id值或id值不是數字則顯示null
        //$articles = null;
        die("id 不存在, 文章未發現");
    }

require_once('includes/header.php');
    echo "<h2>編輯文章</h2>";
require_once('includes/form.php');
require_once('includes/footer.php');

?>