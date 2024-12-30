<?php
//引入db.php/article.php*url.php    
   require_once('includes/db.php');
   require_once('includes/article.php');
   require_once('includes/url.php');

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
        $id = $articles['id'];
        $title = $articles['title'];
        $content = $articles['content'];
        $published_at = $articles['published_at'];
      
    }else{
        //若沒有id值或id值不是數字則顯示null
        //$articles = null;
        die("id 不存在, 文章未發現");
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
        //取得表單資料
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $published_at = htmlspecialchars($_POST['published_at']);
        
        //驗證表單資料
        $errors = ValidateArticle($title, $content, $published_at);
       
       
        //若錯誤陣列為空 則執行
        if(empty($errors)){
            //更新文章
            $sql = "UPDATE article
                    SET title = ?, content = ?, published_at = ?
                    WHERE id = ?";

            $stmt = mysqli_prepare($conn, $sql);
            if($stmt === false){
                echo mysqli_error($conn);
                exit;
            }else{
                mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);
                
                if(mysqli_stmt_execute($stmt)){
                    redirect("/PHP-beginger/article.php?id=$id");
                }
            }
        }
    }

require_once('includes/header.php');
    echo "<h2>編輯文章</h2>";
require_once('includes/form.php');
require_once('includes/footer.php');

?>