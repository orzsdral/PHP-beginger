<?
$arr = [
    "One"=>"Jame",
    "Two"=>"Hardm",
    "Thr"=>"sumjon"];

foreach($arr as $key=>$value){
    echo <<<_END
    <ul>
        <li>The key $key and The value $value</li>
    </ul>
    _END;
}