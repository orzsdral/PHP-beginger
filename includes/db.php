<?php   
/**
 * Get the database connection
 * 
 * @return object Connection to the database
 */
function getDB(){
    $db_host = 'localhost';
    $db_user = 'Anthony';
    $db_password = 'LIN';
    $db_name = 'cms';

    //建立與資料庫連線
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    //判斷$conn是否有物件回傳來，"有"就會值就為True;"沒有"就會回傳False，在用!來取反義
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
        exit;
    }

    return $conn;
}