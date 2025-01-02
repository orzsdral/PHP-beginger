<?php   
 //建立與資料庫的連線
 $db = new DB(); //創建DB物件實例
 return $db->getConn();//使用物件方法