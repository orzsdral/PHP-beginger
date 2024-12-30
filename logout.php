<?php
require_once('includes/url.php');
session_start();

$_SESSION['is_logged_in'] = false;

require_once('includes/header.php');

if (!empty($error)){
    echo "<p>{$error}</p>";
}
echo <<<_END
    <h2>Logout</h2>
    <p>您已登出</p>
    _END;
redirect("/PHP-beginger/index.php");
require_once('includes/footer.php');