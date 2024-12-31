<?php
require "Item.php";
require "book.php";

$my_item = new Item();

$my_item->name="TV";

echo $my_item->getListingDescription();

$book = new book();

$book->author= 'anthony';


echo $book->getListingDescription();
