<?php
    //引入db.php
    require_once('includes/db.php');
    $errors=[];//錯誤訊息集
    //初始化變數
    $title = '';//標題
    $content = '';//內容
    $published_at = '';//日期

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //取得表單資料
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $published_at = htmlspecialchars($_POST['published_at']);

        //檢查是否有輸入標題、內容、日期
        if(empty($title)){
            $errors[] = 'Title is required';
        }
        if(empty($content)){
            $errors[] = 'Content is required';
        }
        //檢查日期格式是否正確
        if(!empty($published_at)){
            //date_create_from_format()函數從指定的格式創建一個新的日期時間,若格式不正確會回傳false 
           if(!date_create_from_format('Y-m-d H:i:s', $published_at)){
                $errors[] = 'Invalid date and time';
           }else{
            //反之，若格式正確，則進一步檢查日期是否正確 date_get_last_errors()函數返回最後一次日期/時間解析的錯誤信息關聯陣列
            $date_errors = date_get_last_errors();
            if($date_errors['warning_count'] > 0){
                $errors[] = 'Invalid date and time';
            }
           }
        }

        //若無錯誤訊息，則執行以下程式碼
        if(empty($errors)){
            //建立與資料庫的連線
            $conn = getDB();
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

                    //檢查伺服器是否使用http或https協議標準方式
                    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https' : 'http';
                    //header()函數用於向瀏覽器發送特定的HTTP標頭
                    header("Location: $protocol://". $_SERVER['HTTP_HOST'] . "/PHP-beginger/article.php?id=$id");
                    exit;
                }
            }
            catch(Exception $e){
                echo "<script>alert('新增失敗,請重新輸入');</script>";
                //無須另外設定也會轉回new-article.php
                //header('Location: new-article.php');
            }
        }
        
    }
      
?>
<?php require_once('includes/header.php'); ?>


    <h2>New article</h2>    
    <form method="post">
        <!-- 若有錯誤訊息，則顯示 -->
    <?php if(!empty($errors)): ?>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div>
        標題:
        <label for="title">
            <!-- 因要練習後端驗證，先去除required設定 -->
             <!-- 設定Value為$title來保留直 -->
            <input type="text" name="title" id="title" placeholder="Article title" value="<?= $title?>">
        </label>
    </div>
    <br>
    <div>
        內容:
        <label for="content">
            <!-- 設定$content保留直 -->
            <textarea name="content" id="content" rows='10' cols='30' placeholder="Article content"><?= $content?></textarea>
        </label>
    </div>
    <br>
    <div>
        日期:
        <label for="published_at">
            <!-- 因要練習後端驗證，先去除required設定 -->
             <!-- 設定$published_at保留直 -->
            <input type="datetime" name="published_at" id="published_at" value="<?= $published_at?>">   
        </label>
    </div>
    <br>

    <div>
        <button>添加</button>
    </div>

    </form>


<?php require_once('includes/footer.php'); ?>