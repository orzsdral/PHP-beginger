<?php
//引入db.php/article.php*url.php   
require_once('classes/DB.php');
require_once('classes/Article.php');
require_once('classes/Url.php');

    //建立與資料庫的連線//改用類別方式連線
    $db = new DB();
    $conn = $db->getConn();

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        $article = Article::getByID($conn, $_GET['id']);

        if (!$article){
          die("文章未發現");
        }
      
    }else{
        die("id 不存在, 文章未發現");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if($article->deleteArticle($conn)){
            Url::redirect("/PHP-beginger/index.php");
        }
    }

    require_once('includes/header.php');

        echo <<<_END
        <h2>刪除文章</h2>
        <form method="post">
            <p>確定要刪除文章: {$article->title}?</p>
                    <button>刪除文章</button>
                    <a href = "article.php?id={$article->id}">取消</a>
        </form>
        _END;
    require_once('includes/footer.php');