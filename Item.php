<?php
//getter / setter
class Item{
    
  public $name;
  public $descript = 'This is the default';
   
  public static $count = 0;  //static 在最前面或後面沒差 

  public function __construct($name, $descript){
        $this->name = $name;
        $this->descript = $descript;
        self::$count++;
  }

    function sayHello(){
    echo 'Hello';
    }

    function getName(){
        return $this->name;   //特殊變量this,表示當前對象(實例)
    }

    public static function showCount(){
        echo static::$count;
    }
}