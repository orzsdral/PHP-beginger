<?php
//引入db.php
   require_once('includes/db.php');
    
    //加入判斷Get來的id是否有值且為數字,此作法可避免使用者透過網址列來輸入非數字的值
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        //建立與資料庫的連線
        $conn = getDB();
        
        //抓取資料庫的資料
        $sql = 'SELECT * 
                FROM article
                WHERE id = ' . $_GET['id'];

        $results = mysqli_query($conn, $sql);
        //判斷$result===false,代表SQL語法有誤
        if($results === false){
            //顯示錯誤訊息
            echo mysqli_error($conn);
            exit;
        }
        // $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
        //改由mysqli_fetch_assoc()來取得資料,從結果集中取得一行作為關聯數組，若無抓回東西會回傳NULL
        $articles = mysqli_fetch_assoc($results);
    }else{
        //若沒有id值或id值不是數字則顯示null
        $articles = null;
    }
?>
<?php require_once('includes/header.php'); ?>


    <main>
        <!-- 因只有一行資料，故不需要foreach去結果集中撈資料 去除了ol/li/foreach-->
        <!-- 加入判斷如果數組是空的不能顯示///因改使用mysqli_fetch_assoc()若回傳無值會顯null因此更換判斷條件 -->
        <?php if($articles === null): ?>
            No articles found.
        <?php else: ?>
                    <h2><?php echo $articles['title']; ?></h2>
                    <p><?php echo $articles['content']; ?></p>
        <?php endif; ?>

<?php require_once('includes/footer.php'); ?>