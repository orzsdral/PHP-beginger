<?php
setcookie('name', 'John', time() - 3600);
var_dump($_COOKIE);