<?php
require "Item.php";


$my_item = new Item();


$my_item->setName('ADD');
$my_item->setdescript('this is function for add');

echo "function_Name:". $my_item->getName() . "<br>"; 
echo "The descript:" . $my_item->getDescript();