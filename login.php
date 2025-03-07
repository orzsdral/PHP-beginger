<?php
//改成自動加載
require_once("includes/init.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = require_once('includes/db.php');
    
    //改用物件方式驗證使用者
    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {
       
        Auth::login();
        
        Url::redirect("/PHP-beginger/index.php");
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
    <h2>登入</h2>
    <form method="post" action="login.php">
        <div class="form-group">
            <label for="username">帳號:</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="password">密碼:</label>
            <input type="password" name="password" id="password">
        </div>
        
        <button class="btn btn-primary">登入</button>
    </form>
    _END;

require_once('includes/footer.php');