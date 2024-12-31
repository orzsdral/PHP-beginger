<?php
require "Item.php";


$my_item = new Item();

$my_item->sayHello();

$my_item->name = 'Jame';
echo ', '. $my_item->getName();
