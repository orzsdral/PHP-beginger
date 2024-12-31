<?php
//getter / setter
class Item{
    
    private $name;
    private $descript ;

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getDescript(){
        return $this->descript;
    }
    public function setDescript($descript){
        $this->descript = $descript;
    }
}