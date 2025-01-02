<?php
$passowrd = '456';
// $hash = password_hash($passowrd, PASSWORD_DEFAULT);

// echo $hash;

$hash = '$2y$10$JKWLBe0gxOArSojv72Jcf.Lq95zAKps03OyQ.xSIMJMzLDLBMxpQu';

var_dump(password_verify($passowrd, $hash));
