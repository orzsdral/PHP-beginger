<?php
    //引入db.php
    require_once('includes/db.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //建立與資料庫的連線
        $conn = getDB();
        
        //取得表單資料
        $title = $_POST['title'];
        $content = $_POST['content'];
        $published_at = $_POST['published_at'];


        //加入try-catch來捕捉錯誤 不直接進入500錯誤頁面
        try{
            //用佔位數來防止SQL注入
            $sql = "INSERT INTO article(title, content, published_at)
                    VALUES(?, ?, ?)";
            //$results = mysqli_query($conn, $sql);
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
            //判斷是否有插入成功 
            echo "Inserted article with id: $id";
            }
        }
        catch(Exception $e){
            echo "<script>alert('新增失敗,請重新輸入');</script>";
            //無須另外設定也會轉回new-article.php
            //header('Location: new-article.php');
        }
      
        
    }
      
?>
<?php require_once('includes/header.php'); ?>

<center>
    <h2>New article</h2>    

    <form method="post">

    <div>
        標題:
        <label for="title">
            <input type="text" name="title" id="title" placeholder="Article title" required>
        </label>
    </div>
    <br>
    <div>
        內容:
        <label for="content">
            <textarea name="content" id="content" rows='10' cols='30' placeholder="Article content"></textarea>
        </label>
    </div>
    <br>
    <div>
        日期:
        <label for="published_at">
            <input type="datetime" name="published_at" id="published_at" required>
        </label>
    </div>
    <br>

    <div>
        <button>添加</button>
    </div>

    </form>
</center>

<?php require_once('includes/footer.php'); ?>