<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHP-beginger/vendor/PHPMailer/src/Exception.php';
require 'PHP-beginger/vendor/PHPMailer/src/PHPMailer.php';
require 'PHP-beginger/vendor/PHPMailer/src/SMTP.php';


require 'includes/init.php';

$email = '';
$subject = '';
$content = '';

$sent = false;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

   $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Email格式錯誤';
    }

    if ($subject == ''){
        $errors[] = '主旨不得為空';
    }

    if  ($content == ''){
        $errors[] = '內容不得為空';
    }

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();  //告訴PHPMailer使用SMTP
            $mail->Host = SMTP_HOST; //告訴PHPMailer伺服器位置
            $mail->SMTPAuth = true;  //告訴PHPMailer需要身分驗證
            $mail->Username = SMTP_USER; //設置帳號
            $mail->Password = SMTP_PASS; //設置密碼
            $mail->SMTPSecure = 'tls'; //身分驗證類ㄧ
            $mail->Port = 587;  //port
            
            $mail->setFrom('sender@daveh.io');//設寄信者
            $mail->addAddress('reciptin@daveh.io');//設定收件者
            $mail->addReplyTo($email); //設定回覆地址
            $mail->Subject = $dubject; //設定主旨
            $mail->Body = $content;  //設定內文
            
            $mail->send(); //寄信
            
            echo "已寄出";
        } catch (Exception $e){
            $errors[] = $mail->ErrorInfo;
        }
    }

}


?>

<?php require 'includes/header.php'; ?>

<h2>聯絡我們</h2>

<?php if($sent): ?>
    <div class="alert alert-success">已寄出</div>
<?php else: ?>
    <?php if(!empty($errors)): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php endif; ?>



<form method="post" id="formContact">
    <div class="form-group">
        <label>Email:
            <input class="form-control" type="email" name="email" placeholder="請輸入您的Email" value="<?= htmlspecialchars($email)?>" >
        </label>
    </div>

    <div class="form-group">
        <label>主旨:
            <input class="form-control" type="text" name="subject" placeholder="請輸入主旨" value="<?= htmlspecialchars($subject)?>" >
        </label>
    </div>

    <div class="form-group">
        <label>內容:
            <textarea class="form-control" name="content" placeholder="請輸入內容"  rows="30" cols="100"  ><?= htmlspecialchars($content)?></textarea>
        </label>
    </div>
    
    <button class="btn btn-primary">送出</button>
</form>
<?php require 'includes/footer.php'; ?>