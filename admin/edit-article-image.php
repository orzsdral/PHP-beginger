<?php
//改成自動加載
require_once("../includes/init.php");
Auth::requireLogin();
    $conn = require_once('../includes/db.php');

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        $article = Article::getByID($conn, $_GET['id']);

        if (!$article){
          die("文章未發現");
        }
 
      
    }else{
        die("id 不存在, 文章未發現");
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
       var_dump($_FILES);
       try{
            //跟post_max_size有關
            if(empty($_FILES))
            {
                throw new Exception('無效上傳');
            }
            
            //檢查檔案上傳是否成功
            switch ($_FILES['file']['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new Exception('未上傳檔案');
                        break;
                    //跟upload_max_filesize有關    
                    case UPLOAD_ERR_INI_SIZE:
                        throw new Exception('檔案過大');
                        break;
                    default:
                        throw new Exception('其他錯誤');
                     
            } 
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

require_once('../includes/header.php');
    echo "<h2>編輯文章圖片</h2>";
echo <<<END
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="file">圖片</label>
            <input type="file" name="file" id="file">
            
        </div>
        <button>更新</button>
    
    </form>
END;
require_once('../includes/footer.php');

?>