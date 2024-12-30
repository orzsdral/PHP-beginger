<?php
    //引入db.php/article.php/url.php/auth.php
    require_once('includes/db.php');
    require_once('includes/article.php');
    require_once('includes/url.php');
    require_once('includes/auth.php');
  
session_start();
//檢查是否登入
if(!isLoggedIn()){
    die('請先登入');
}

    //初始化變數
    $title = '';//標題
    $content = '';//內容
    $published_at = '';//日期
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
        //取得表單資料
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $published_at = htmlspecialchars($_POST['published_at']);
        
        //驗證表單資料
        $errors = ValidateArticle($title, $content, $published_at);
       
       
        //若錯誤陣列為空 則執行
        if(empty($errors)){
            //加入try-catch來捕捉錯誤 不直接進入500錯誤頁面
            try{
                //建立與資料庫的連線
                $conn = getDB();

                //用佔位數來防止SQL注入
                $sql = "INSERT INTO article(title, content, published_at)
                        VALUES(?, ?, ?)";

                //mysqli_prepare()函數準備要執行的SQL語句
                $stmt = mysqli_prepare($conn, $sql);
                if($stmt === false){
                    echo mysqli_error($conn);
                    exit;
                }else{
                    //mysqli_stmt_bind_param()函數將變量綁定到準備好的語句中
                    // s 代表 string i 代表 integer d 代表 double b 代表 blob
                    mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);
                    //mysqli_stmt_execute()函數執行準備好的語句
                    if(!mysqli_stmt_execute($stmt)){
                        echo mysqli_stmt_error($stmt);
                        exit; 
                    }

                    //mysqli_insert_id()函數返回上一個查詢中自動生成的ID
                    $id = mysqli_insert_id($conn);
                    redirect("/PHP-beginger/article.php?id=$id");
                    
                }
            }
            catch(Exception $e){
                echo "<script>alert('新增失敗,請重新輸入');</script>";
                //無須另外設定也會轉回new-article.php
                //header('Location: new-article.php');
            }
        }
      
        
    }

require_once('includes/header.php');

   echo "<h2>新增文章</h2>";    

require_once('includes/form.php');    

require_once('includes/footer.php'); ?>