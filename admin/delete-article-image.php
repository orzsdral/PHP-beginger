<?php
//改成自動加載
require_once("../includes/init.php");
Auth::requireLogin();
    $conn = require_once('../includes/db.php');

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        $articles = Article::getByID($conn, $_GET['id']);

        if (!$articles){
          die("文章未發現");
        }
 
      
    }else{
        die("id 不存在, 文章未發現");
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      
        $previous_image = $articles->image_file;

        if($articles->setImageFile($conn, null)){

            if ($previous_image){
                //刪除圖片檔案
                unlink("../uploads/$previous_image");
            }

            Url::redirect("/PHP-beginger/admin/edit-article-image.php?id={$articles->id}");

        }
    }

require_once('../includes/header.php');
    echo "<h2>刪除文章圖片</h2>";
    if ($articles->image_file){
      echo 
      "<img src=\"../uploads/$articles->image_file\">";
    }

echo <<<END
    
    
    <form method="post" >
        <p> Are you sure you want to delete this image?</p>
        <button>刪除</button>
        <a href="edit-article-image.php?id={$articles->id}">取消</a>
    </form>
END;
require_once('../includes/footer.php');

?>