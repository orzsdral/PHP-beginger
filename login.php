<?php
require_once('includes/url.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'Anthony' && $_POST['password'] === 'LIN') {
        $_SESSION['is_logged_in'] = true;
        
        redirect("/PHP-beginger/index.php");
        exit;
    } else {
        $error = '帳號或密碼錯誤';
    }
}


require_once('includes/header.php');
if (!empty($error)){
    echo "<p>{$error}</p>";
}
echo <<<_END
    <h2>Login</h2>
    <form method="post" action="login.php">
        <div>
            <label for="username">帳號:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">密碼:</label>
            <input type="password" name="password" id="password">
        </div>
        <input type="submit" value="Login">
    </form>
    _END;

require_once('includes/footer.php');