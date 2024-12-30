<?php
/**
 * 檢查是否登入
 * 
 * @return bool true if logged in, false otherwise
 */
function isLoggedIn(){
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}