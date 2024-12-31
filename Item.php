<?php
class Item{
    
    private $name;
    public $descript = 'the old post';


    //建構函數--每次使用此物件會自動執行它，通常被用來做初始化動作
    function __construct($name, $descript){
        $this->name = $name;
        $this->descript = $descript;


    }
    ///它通常會放置在此 所有方法前

    function sayHello(){
        echo 'Hello';
    }

    function getName(){
        return $this->name;   //特殊變量this,表示當前對象(實例)
    }
}