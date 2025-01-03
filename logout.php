<?php
//改成自動加載
require_once("includes/init.php");

Auth::logout();

Url::redirect("/PHP-beginger/index.php");