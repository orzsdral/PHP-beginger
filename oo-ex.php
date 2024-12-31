<?php
require "Item.php";
require "book.php";

$my_item = new Item();

//echo $my_item->code;

$book = new book();


echo $book->getcode();