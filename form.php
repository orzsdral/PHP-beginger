<?php
//$_SERVER['REQUEST_METHOD']是一個超全域變數，包含了網頁請求的資訊 看是用GET還是POST
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
    <!-- 設定表單方式為post -->
    <form method="post">
        <input type="text" name="val">
        <input type="email" name="mail">
        <input type="submit" name="submit">
        <input type="number" name="number">
        <input type="password" name="password">
        <input type="date" name="date">
        <input type="time" name="time">
        <input type="url" name="url">
        <input type="tel" name="tel">
        <input type="color" name="color">
        <input type="range" name="range">
        <input type="file" name="file">
        <input type="hidden" name="hidden">
        <input type="submit" name="submit">
        <input type="reset" name="reset">
        <input type="radio" name="radio">
        <input type="checkbox" name="checkbox">
        <input type="image" name="image">
        <input type="button" name="button">
        <input type="datetime-local" name="datetime-local">
        <input type="month" name="month">
        <input type="week" name="week">
        <input type="other" name="other">
    </form>
</body>
</html>