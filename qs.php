<?php
//http://localhost/PHP-beginger/qs.php?789=456  假如網址長這樣
    echo $_SERVER['QUERY_STRING'] ;  //輸出 789=456
    var_dump($_GET) ;               //輸出 array(1) { ["789"]=> string(3) "456" }
    echo $_GET['789'] ;             //輸出 456