<?php
class Item{
    public $name;

   protected $code ='123';

    public function getListingDescription(){
        return $this->name;
    }
}