<?php
/**
 * URL
 * 
 * 回應方法
 */
class Url{
    /**
     * 重定向到指定的URL
     * @param string $path 指定重訂向路徑
     * 
     * @return void (若無回傳值,則將void作為回傳值)
    */
    public static function redirect($path){
        //檢查伺服器是否使用http或https協議標準方式
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
            $protocol = 'https';
        }else{
            $protocol = 'http';
        }
        //header()函數用於向瀏覽器發送特定的HTTP標頭
        header("Location: $protocol://". $_SERVER['HTTP_HOST'] . $path);
        exit;
    }
}