<?php
/**
 * Category種類
 * 
 * 文章群族
 */
class Category{
    
    /** 
     *取得全部種類
     * 
     * @param object $conn 連接資料庫
     * 
     * 
    * @return assoc_array 全部的種類記錄
    */

    public static function getAll($conn){
        $sql = "SELECT * 
                FROM category
                ORDER BY name";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }  


}