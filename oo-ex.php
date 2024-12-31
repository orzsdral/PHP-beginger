<?php
require "Item.php";


//可重複建立多個物件實例
$my_item = new Item();
var_dump($my_item);

$item2 = new Item();
var_dump($item2);