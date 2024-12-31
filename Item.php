<?php
//其內部通常會先定義屬性 方法在下方
class Item{
    
    public $name;
    public $descript = 'the old post';

    function sayHello(){
        echo 'Hello';
    }

    function getName(){
        return $this->name;   //特殊變量this,表示當前對象(實例)
    }
}