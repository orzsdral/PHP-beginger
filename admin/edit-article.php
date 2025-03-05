<?php
//改成自動加載
require_once("../includes/init.php");
Auth::requireLogin();
    $conn = require_once('../includes/db.php');

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
    //取得文章的種類單id的所有資料
    $category_ids = array_column($article->getCategories($conn), 'id');
    $categories = Category::getAll($conn);
  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
        //取得表單資料
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->published_at = $_POST['published_at'];
        
        //驗證改由物件內部處理
                
        if($article->updateArticle($conn)){
            Url::redirect("/PHP-beginger/admin/article.php?id={$article->id}");
        }
    }

require_once('../includes/header.php');
    echo "<h2>編輯文章</h2>";
require_once('includes/form.php');
require_once('../includes/footer.php');

?>