<?php
    /**
     * 用戶驗證
     * 
     * 登入和登出
     */
    class Auth{
    /**
     * 檢查是否登入
     * 
     * @return bool true if logged in, false otherwise
     */
    public static function isLoggedIn(){
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }
}