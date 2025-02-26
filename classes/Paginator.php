<?php
class Paginator{
    /**
     * 紀錄限制筆數
     * @var integer
     */
    public $limit;
    
    /**
     * 每頁略過的紀錄筆數
     * @var integer
     */
    public $offset;

    /**
     * 上一頁
     * @var integer
     */
    public $previous;

    /** 
     * 下一頁
     * @var integer
     */
    public $next;

    /**
     * 總頁數
     */
    public $total_pages;

    /**
     * 總紀錄筆數
     */
    public $total_records;

    /**
     * 建構式Consctructor
     * 
     * @param integer $page 頁數
     * 
     * @param integer $records_per_page 每頁的紀錄筆數
     * 
     * @return void
     */

    public function __construct($page, $records_per_page ,$total_records){
        $this->limit = $records_per_page;

       
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options'=>[  
            'default'=> 1,
            'min_range' => 1,
            'max_range' => 5
            ]
        ]);
        if ($page > 1){ 
            $this->previous = $page - 1;
        }

        $total_pages = ceil($total_records / $records_per_page);

        if ($page < $total_pages){
            $this->next = $page + 1;
        }
        

        $this->offset = $records_per_page * ($page - 1);
    }
}