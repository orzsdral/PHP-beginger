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
    
        $dsn = 'msyql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
        
        return new PDO($dsn, $db_user, $db_password);
    }
}