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
     * 錯誤訊息
     * @var array
    */
    public $errors = [];

    /**
     * 圖片路徑
     * $image_file
     */
    public $image_file;
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
     * 取得分頁的文章數
     * 
     * @param object $conn 連接資料庫
     * @param integer $limit 紀錄筆數
     * @param integer $offset 略過幾筆
     *
     * @return array 回傳幾筆文章聯想陣列範圍
     */

    public static function getPage($conn, $limit, $offset){
        $sql = "SELECT a.*, category.name AS category_name
                FROM (SELECT * 
                FROM article
                ORDER BY published_at
                LIMIT :limit
                OFFSET :offset) AS a
                LEFT JOIN article_category
                ON a.id = article_category.article_id
                LEFT JOIN category
                ON article_category.category_id = category.id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $articles = [];

        $previous_id = null;

        foreach ($results as $row){

            $article_id = $row['id'];

            if ($article_id != $previous_id){
               $row['category_names'] = [];
                $articles[$article_id] = $row;
            }

            $articles[$article_id]['category_names'][] = $row['category_name'];

            $previous_id = $article_id;
            
            
        }

        return $articles;
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
     * 藉由ID獲取文章記錄，使用關聯category表
     * 
     * @param object $conn 連接資料庫
     * @param integer $id 文章 ID
     * 
     * @return array 一個包含文章記錄資料的聯想陣列
     */
    public static function getWithCategories($conn, $id){
        $sql = "SELECT article.*,category.name as category_name
                FROM article
                LEFT JOIN article_category
                ON article.id = article_category.article_id
                LEFT JOIN category
                ON article_category.category_id = category.id
                WHERE article.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * 取得文章的分類
     * @param object $conn 連接資料庫
     * 
     * @return array 一個包含文章分類的聯想陣列
     */
    public function getCategories($conn){
        $sql = "SELECT category.*
                FROM category
                JOIN article_category
                ON category.id = article_category.category_id
                WHERE article_id = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 設定文章種類
     * 
     * @param object $conn 連接資料庫
     * @param array $ids 種類ID
     * 
     * @return void 沒有回傳值
     */
    public function setCategories($conn, $ids){
        if ($ids){
            $sql = "INSERT IGNORE INTO article_category (article_id, category_id)
                    VALUES ";
            //建立一個空陣列
            $values = [];
            //將每個ID加入陣列
            foreach($ids as $id){
                $values[] = "({$this->id}, ?)";
            }
            //將陣列轉換成字串並用逗號分隔
            $sql .=  implode(',', $values);
        
            $stmt = $conn->prepare($sql);
            
            foreach($ids as $i => $id){
                $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
            }
            $stmt->execute();
        }

        $sql = "DELETE FROM article_category
                WHERE article_id = {$this->id}";
        
        if ($ids){
            $placeholders = array_fill(0, count($ids), '?');
            $sql .= " AND category_id NOT IN (" . implode(',', $placeholders) . ")";
        }
        $stmt = $conn->prepare($sql);

        foreach($ids as $i => $id){
            $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
        }
        $stmt->execute();
    }

    /** 
     * 更新文章 --使用現在屬性值
     * 
     * @param object $conn 連接資料庫
     * 
     * @return boolean 是否成功更新
     */

    public function updateArticle($conn){
        //在更新時直接做驗證，所以此驗證函數設定成protected
        if ($this->Validate()){
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
        } else {
            return false;
        }
    }

/**
 * 驗證文章內容 --放置任何錯誤訊息在一個$errors屬性中

 * 
 * @return array 布林 如果是True 表示沒有錯誤,否則有錯誤
 */

    protected function Validate(){
        
    
        
        //增檢查是否有空值
        if(empty($this->title)){
            $this->errors[] = '標題須填寫';
        }
        if(empty($this->content)){
            $this->errors[] = '內容須填寫';
        }
        if(!empty($this->published_at)){
            //date_create_from_format()函數從指定的格式創建一個新的日期時間,若格式不正確會回傳false 
        if(!date_create_from_format('Y-m-d H:i:s', $this->published_at)){
                $this->errors[] = 'Invalid date and time';
        }else{
            //反之，若格式正確，則進一步檢查日期是否正確 date_get_last_errors()函數返回最後一次日期/時間解析的錯誤信息關聯陣列
            $date_errors = date_get_last_errors();
            if($date_errors['warning_count'] > 0){
                $this->errors[] = 'Invalid date and time';
            }
        }
        }
        return empty($this->errors);
    }

    /**
     * 取得總共的紀錄筆數
     * 
     * @param object $conn 連接資料庫
     * 
     * @return integer 總共的紀錄筆數
     */
    public static function getTotal($conn){
 
        return $conn->query("SELECT COUNT(*) FROM article")->fetchColumn();

    }

    /**
     * 刪除文章
     * 
     * @param object $conn 連接資料庫
     * 
     * @return boolean 是否成功刪除
     */

    public function deleteArticle($conn){
        $sql = "DELETE FROM article
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    /** 
     * 新增文章 --使用現在屬性值
     * 
     * @param object $conn 連接資料庫
     * 
     * @return boolean 是否成功更新
     */

     public function createArticle($conn){
        //在更新時直接做驗證，所以此驗證函數設定成protected
        if ($this->Validate()){
            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES (:title, :content, :published_at)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            ($this->published_at == '')?($stmt->bindValue(':published_at', null, PDO::PARAM_NULL)) : ($stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR));

            if ($stmt->execute()){
                $this->id = $conn->lastInsertId();
                return true;
            } 
        } else {
            return false;
        }
    }

    /**
     * 上傳圖片檔屬性
     * 
     * @param object $conn 連接資料庫
     * @param string $image_file 圖片檔名
     * 
     * @return boolean 是否成功更新
     */
    public function setImageFile($conn, $image_file){
        $sql = "UPDATE article
                SET image_file = :image_file
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':image_file', $image_file, $image_file == null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        return $stmt->execute();
    }


}