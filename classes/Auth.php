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

    /**
     * 需使用者登入,否則顯示"請先登入"訊息
     * 
     * @return void
     */
    public static function requireLogin(){
        if(!static::isLoggedIn()){
            die('請先登入');
        }
    }

    /**
     * 登入使用Session
     * 
     * @return void
     */

    public static function login(){
         //重新產生 session id 避免 session fixation
         session_regenerate_id(true);
         $_SESSION['is_logged_in'] = true;
    }

    /**
    *
    */
    public static function logout(){
       
        $_SESSION = [];

        if (ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 442000, 
                $params["path"], $param["domain"] , $param["secure"], $param["httponly"]);
                
        }

        session_destroy();

    }


}