<?php
/**
 *文章類別
 *
 * 
 */
class Article{
    /**
     * 唯一的辨識
     * @var integer
     */
    public $id;
    /**
     * 文章標題
     * @var string
     */
	public $title;
    /** 
     * 文章內容
     * @var string
     */
	public $content;
    /**
     * 文章發布時間
     * @var string
     */
	public $published_at;



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
 * @return mixed 一個類別物件 或 null 如果沒有找到
 */
    public static function getByID($conn, $id, $columns='*'){
        $sql ="SELECT $columns
            FROM article
            WHERE id = :id";

        $stmt = $conn->prepare($sql);
        //去除錯誤判斷以在物件內部做了

        //PDO綁定參數方式
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        //改成設定為對象回傳,傳遞欲返回的類別名稱
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        //PDO執行語句方式
        if($stmt->execute()){
            //return $stmt->fetch(PDO::FETCH_ASSOC);
            //改成為回傳物件
            return $stmt->fetch();
        }
    }

    /** 
     * 更新文章 --使用現在屬性值
     * 
     * @param object $conn 連接資料庫
     * 
     * @return boolean 是否成功更新
     */

    public function updateArticle($conn){
        $sql = "UPDATE article
                SET title = :title,
                    content = :content,
                    published_at = :published_at
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
        ($this->published_at == '')?($stmt->bindValue(':published_at', null, PDO::PARAM_NULL)) : ($stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR));

        return $stmt->execute();
    }

}