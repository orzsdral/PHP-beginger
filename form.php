<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $val = $_POST['val'];
    $val2 = $_POST['val2'];

    echo $val;
    echo $val2;
}

    ?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    
    <title>Form</title>
</head>
<body>
    <form method="post">
        <input type="text" name="val">
        <input type="text" name="val2">
        <button>send</button>
    </form>
</body>
</html>