<?php
/**
 * 初始化文件
 * 
 * 1. 自動加載類別
 * 
 * 2. 啟動session
 *
 */   
spl_autoload_register(function($class){
    require_once("classes/{$class}.php");
});

session_start();