<?php
//引入db.php/article.php*url.php   
require_once('classes/DB.php');
require_once('classes/Article.php');
   require_once('includes/url.php');

    //建立與資料庫的連線//改用類別方式連線
    $db =new DB();
    $conn = $db->getConn();

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        $article = Article::getByID($conn, $_GET['id']);

        if (!$article){
          die("文章未發現");
        }
 
      
    }else{
        //若沒有id值或id值不是數字則顯示null
        //$articles = null;
        die("id 不存在, 文章未發現");
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
        //取得表單資料
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->published_at = $_POST['published_at'];
        
        //驗證改由物件內部處理
                
        if($article->updateArticle($conn)){
            redirect("/PHP-beginger/article.php?id={$article->id}");
        }
    }

require_once('includes/header.php');
    echo "<h2>編輯文章</h2>";
require_once('includes/form.php');
require_once('includes/footer.php');

?>