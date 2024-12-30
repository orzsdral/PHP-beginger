<?php   
session_start();
$_SESSION['name'] = 'John';

if (isset($_SESSION['count'])){
    $_SESSION['count']++;
}else{
    $_SESSION['count'] = 1;
}

echo session_save_path();

session_destroy();
var_dump($_COOKIE);
?>
<a href="setcookie.php">set</a>
<a href="delcookie.php">del</a>