<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //引入db.php
        require_once('includes/db.php');

        //取得表單資料
        $title = $_POST['title'];
        $content = $_POST['content'];
        $published_at = $_POST['published_at'];

        //寫入資料庫
        $sql = "INSERT INTO article(title, content, published_at)
                VALUES('$title', '$content', '$published_at')";
        $results = mysqli_query($conn, $sql);
        //判斷$result===false,代表SQL語法有誤
        if($results === false){
            //顯示錯誤訊息
            echo mysqli_error($conn);
            exit;
        }
        //mysqli_insert_id()函數返回上一個查詢中自動生成的ID
        $id = mysqli_insert_id($conn);
        echo "Inserted article with id: $id";
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