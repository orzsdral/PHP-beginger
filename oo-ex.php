<?php
require "Item.php";

//傳遞參數給件構函數
$my_item = new Item('same', 'the moudle!!');

var_dump($my_item->descript);

var_dump($my_item->name);//設成private 會無法在這值接使用，只能在物件內使用
