<?php       
/** 
 * 
 * @param string $message 傳送字串訊息 integer $num1 整數1 integer $num2若無給值則預設為15
 *  
 *  
 * @return integer $sum 回傳兩數相加的結果
 */

function showmessage($message) {
    echo $message;
}

showmessage('Hello World!');

function addsum($num1, $num2=15) {
    $sum = $num1 + $num2;
    return $sum;
}

echo $sum = addsum(10);
