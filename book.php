<?php 
class book extends Item{
    
    public $author;

    public function getListingDescription(){
        return parent::getListingDescription() . 'by' . $this->author;
    }
}