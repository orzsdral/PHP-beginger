<?php
require "Item.php";


$my_item = new Item();

$my_item->name = 'example';
$my_item->descript = 'a new post';
$my_item->price = 12.99;  //PHP允許不需先定義在類別物件裡面也可使用，但不建議這樣使用 不易維護

var_dump($my_item->price);