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
        $articles = getArticle($conn, $_GET['id'], 'id');

        if ($articles === null){
          die("文章未發現");
        }
        //取得文章資訊
        $id = $articles['id'];
      
    }else{
        //若沒有id值或id值不是數字則顯示null
        //$articles = null;
        die("id 不存在, 文章未發現");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $sql = "DELETE FROM article 
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);
        if($stmt === false){
            echo mysqli_error($conn);
            exit;
        }
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)){
            redirect("/PHP-beginger/index.php");
        }else{
            echo mysqli_stmt_error($stmt);
        }
    }

    require_once('includes/header.php');

        echo <<<_END
        <h2>刪除文章</h2>
        <form method="post">
            <p>確定要刪除文章: {$title}?</p>
                    <button>刪除文章</button>
                    <a href = "article.php?id={$id}">取消</a>
        </form>
        _END;
    require_once('includes/footer.php');