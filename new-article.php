<?php
//改成自動加載
require_once("includes/init.php");

  
//session_start();
//檢查是否登入
// if(!Auth::isLoggedIn()){
//     die('請先登入');
// }
Auth::requireLogin();


    $article = new Article();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
        $conn = require_once('includes/db.php');

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