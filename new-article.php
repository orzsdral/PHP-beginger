<?php
    //引入db.php/article.php/url.php/auth.php
require_once('classes/DB.php');
require_once('classes/Article.php');
require_once('classes/Auth.php');
require_once('classes/Url.php');

  
session_start();
//檢查是否登入
if(!Auth::isLoggedIn()){
    die('請先登入');
}

    $article = new Article();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
        $db = new DB();
        $conn = $db->getConn();

        //取得表單資料
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->published_at = $_POST['published_at'];
        
        //驗證改由物件內部處理
                
        if($article->createArticle($conn)){
            Url::redirect("/PHP-beginger/article.php?id={$article->id}");
        }
       
       
        
      
        
    }

require_once('includes/header.php');

   echo "<h2>新增文章</h2>";    

require_once('includes/form.php');    

require_once('includes/footer.php'); ?>