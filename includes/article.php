<?php
/**
 * 藉由ID得到文章
 * 
 * @param object $conn 連接資料庫
 * @param integer $id 文章 ID
 * @param string $columns 要選取的欄位,預設為所有欄位
 * 
 * @return assoc_array The article record with that ID,or null if not found
 */
Function getArticle($conn, $id, $columns='*'){
    $sql ="SELECT $columns
         FROM article
         WHERE id = :id";

    $stmt = $conn->prepare($sql);
    //去除錯誤判斷以在物件內部做了

    //PDO綁定參數方式
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    //PDO執行語句方式
    if($stmt->execute()){
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

}


/**
 * 驗證文章內容
 * 
 * @param string $title 文章標題
 * @param string $content 文章內容
 * @param string $published_at 文章日期
 * 
 * @return array 錯誤訊息
 */

function ValidateArticle($title, $content, $published_at){
    
    $errors = [];
    
    //增檢查是否有空值
    if(empty($_POST['title'])){
        $errors[] = '標題須填寫';
    }
    if(empty($_POST['content'])){
        $errors[] = '內容須填寫';
    }
    if(!empty($published_at)){
        //date_create_from_format()函數從指定的格式創建一個新的日期時間,若格式不正確會回傳false 
       if(!date_create_from_format('Y-m-d H:i:s', $published_at)){
            $errors[] = 'Invalid date and time';
       }else{
        //反之，若格式正確，則進一步檢查日期是否正確 date_get_last_errors()函數返回最後一次日期/時間解析的錯誤信息關聯陣列
        $date_errors = date_get_last_errors();
        if($date_errors['warning_count'] > 0){
            $errors[] = 'Invalid date and time';
        }
       }
    }
    return $errors;
}

