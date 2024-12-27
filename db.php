<?php   
$db_host = 'localhost';
$db_user = 'Anthony';
$db_password = 'LIN';
$db_name = 'cms';

//建立與資料庫連線
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

//判斷$conn是否有物件回傳來，"有"就會值就為True;"沒有"就會回傳False，在用!來取反義
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}


//抓取資料庫的資料
$sql = 'SELECT * 
        FROM article 
        ORDER BY published_at';

//執行SQL語法,並回傳結果集  mysqli_query(連線物件, SQL語法)，若有錯誤會回傳false;反之則回傳結果集物件
$results = mysqli_query($conn, $sql);
    //判斷$result===false,代表SQL語法有誤
    if($results === false){
        //顯示錯誤訊息
        echo mysqli_error($conn);
    }else{
        //mysqli_fetch_row()函數從結果集中取得一行作為數值陣列
        //mysqli_fetch_all()函數從結果集中取得所有行作為數值陣列
        //mysqli_fetch_assoc()函數從結果集中取得一行作為關聯陣列
        //將結果集轉換成陣列
        $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);//MYSQLI_ASSOC:使表格欄位名行成鍵取代數字變成關聯陣列 
        var_dump($articles);

        foreach($articles as $article){
             echo $article['id'] . $article['title'] . $article['content'] . $article['published_at'] . '<br>';
               

        }
}