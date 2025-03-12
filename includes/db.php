<?php   
 //建立與資料庫的連線
 $db = new DB(DB_HOST, DB_NAME, DB_USER, DB_PASS); //創建DB物件實例
 return $db->getConn();//使用物件方法