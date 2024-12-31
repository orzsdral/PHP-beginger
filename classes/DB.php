<?php
class DB{
    /**
     * 建立資料庫連線
     * 
     * @return
     */

    public function getConn(){
        $db_host = 'localhost';
        $db_user = 'Anthony';
        $db_password = 'LIN';
        $db_name = 'cms';
    
        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
        

        try{
            $db = new PDO($dsn, $db_user, $db_password); 
            $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //通過這設置可在處理資料庫錯誤時拋出異常

            return $db;
        } catch (PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
}