<?php
/**
 * 使用者
 * 
 * 個人或整理可被記錄在網站
 */
class User{
    /**
     * 使用者 ID INT
     */
    public $id;
    /**
     * 使用者名稱 string
     */
    public $username;
    /**
     * 密碼 string
     */
    public $password;
    /**
     * 驗證用戶藉由帳密
     * 
     * @param string $username 使用者名稱
     * @param string $password 密碼
     * 
     * @return bool 驗證成功為 true, 失敗為 false
     * 
     */
    public static function authenticate($username, $password){
      return ($username === 'Anthony' && $password === 'LIN');

    }

}