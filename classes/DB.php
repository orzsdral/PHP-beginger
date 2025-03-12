<?php
class DB{
    /**
     * Hostname
     */
    protected $db_host;
    /**
     * Database name
     */
    protected $db_name;
    /**
     * Database user
     */
    protected $db_user;
    /**
     * Database password
     */
    protected $db_password;

    /**
     * Constructor
     */
    public function __construct($host, $name, $user, $password){
        $this->db_host = $host;
        $this->db_name =  $name;
        $this->db_user = $user;
        $this->db_password = $password;
    }
    /**
     * 建立資料庫連線
     * 
     * @return
     */
    public function getConn(){
    
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8';
       

        try{
            $db = new PDO($dsn, $this->db_user, $this->db_password); 
     
            $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //通過這設置可在處理資料庫錯誤時拋出異常

            return $db;
        } catch (PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
}