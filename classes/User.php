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
     * @param string $conn 和資料庫連線
     * @param string $username 使用者名稱
     * @param string $password 密碼
     * 
     * @return bool 驗證成功為 true, 失敗為 自動回傳null
     * 
     */
    public static function authenticate($conn, $username, $password){
        $sql = "SELECT * FROM user 
                WHERE username =:username"; 

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        //這行很重要本它轉成物件
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();
        
        if($user = $stmt->fetch()){
                return $user->password == $password;
        }
    }    
   

}