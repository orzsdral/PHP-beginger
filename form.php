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
        <div>
            POSC
            <input type="postcode" name="posc" placeholder="請輸入郵遞區號"
                   pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]?[0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" 
                   title="請輸入正確的郵遞區號"> 
        </div>
        <br>
        <div>
            EMAIL
            <input type="email" name="email" placeholder="請輸入email" required>
        </div>
        <br>
        <div>
            NUMBER
            <input type="number" name="number" placeholder="請輸入數字" min="1" max="10">
        </div>
        <br>
            <button>send</button>
    </form>
</body>
</html>