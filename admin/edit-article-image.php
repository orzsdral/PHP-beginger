<?php
//改成自動加載
require_once("../includes/init.php");
Auth::requireLogin();
    $conn = require_once('../includes/db.php');

    //有改用準備語句，所以可去除is_numeric()判斷
    if(isset($_GET['id'])){
        //取得文章
        $articles = Article::getByID($conn, $_GET['id']);

        if (!$articles){
          die("文章未發現");
        }
 
      
    }else{
        die("id 不存在, 文章未發現");
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
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
            
            //限制檔案大小
            if($_FILES['file']['size'] > 1000000){
                throw new Exception('檔案過大');
            }
            
            //限制檔案類型
            $mime_types = [
                'image/gif' => '.gif',
                'image/jpeg' => '.jpg',
                'image/png' => '.png',
            ];
           
           

            //$finfo = finfo_open(FILEINFO_MIME_TYPE);
            //$mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
            
            //if (!in_array($mime_type, $mime_types)){
            if( !array_key_exists($_FILES['file']['type'], $mime_types)){
                throw new Exception('無效類型');
            }


            

            //取得檔案資訊
            $pathinfo = pathinfo($_FILES['file']['name']);
            
            //取得檔名
            $base = $pathinfo['filename'];  
            
            //過濾檔名(允許顯示字元,取代非允許字元,檔名)
            $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

            //限制檔名長度
            $base = mb_substr($base, 0, 200);

            //組合檔名
            $filename = $base . "." . $pathinfo['extension'];

            //設定目的地
            $destination = "../uploads/$filename";
            $i = 1;
            //檢查目標位置是否已存在相關檔案
            While (file_exists($destination)){
                //組合檔名
                $filename = $base . "-$i." . $pathinfo['extension'];
                $destination = "../uploads/$filename";
                $i++;
            }
           
            //移動檔案
            if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
                //更新資料庫
                if ($articles->setImageFile($conn, $filename)){
                    //取得舊圖片檔名
                    $previous_image = $articles->image_file;
                    if ($previous_image){
                        //刪除圖片檔案
                        unlink("../uploads/$previous_image");
                    }

                    Url::redirect("/PHP-beginger/admin/edit-article-image.php?id={$articles->id}");

               }
               
            }else {
                throw new Exception('檔案上傳失敗');
            }


        }catch(Exception $e){
            $error = $e->getMessage();
        }
    }

require_once('../includes/header.php');
    echo "<h2>編輯文章圖片</h2>";
    if ($articles->image_file){
      echo 
      "<img src=\"../uploads/$articles->image_file\">";
      echo
      "<a class='delete' href=\"delete-article-image.php?id= $articles->id\">刪除圖片</a>";
    }

    if (isset($error)){
        echo "<p>$error</p>";
    }

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