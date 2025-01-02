<?php
/**
 *文章類別
 *
 * 
 */
class Article{
    /** 
     * 藉由ID得到文章
     * 
     * @param object $conn 連接資料庫
     * 
     * 
    * @return assoc_array 全部的文章記錄
    */

    public static function getAll($conn){
        $sql = "SELECT * 
                FROM article
                ORDER BY published_at";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }  


/**
 * 藉由ID得到文章
 * 
 * @param object $conn 連接資料庫
 * @param integer $id 文章 ID
 * @param string $columns 要選取的欄位,預設為所有欄位
 * 
 * @return assoc_array The article record with that ID,or null if not found
 */
    public static function getByID($conn, $id, $columns='*'){
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

}