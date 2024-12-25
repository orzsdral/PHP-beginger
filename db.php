<?php   
$db_host = 'localhost';
$db_user = 'Anthonys';
$db_password = 'LIN';
$db_name = 'cms';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

//判斷$conn是否有物件回傳來，"有"就會值就為True;"沒有"就會回傳False，在用!來取反義
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}else {
    echo 'Connection success';
}

//判斷mysqli_connect_errno()有無回傳值，"有"代表有異常;"沒有"就是連線成功
// if(mysqli_connect_errno()){
//     echo 'Failed to connect to MySQL '. mysqli_connect_errno();
  
// }else {
//      echo 'Connection success';
// }