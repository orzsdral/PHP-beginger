<?php
require 'includes/init.php';

$email = '';
$subject = '';
$content = '';

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

    }

}


?>

<?php require 'includes/header.php'; ?>

<h2>聯絡我們</h2>

<?php if(!empty($errors)): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" id="formContact">
    <div>
        <label>Email:
            <input type="email" name="email" placeholder="請輸入您的Email" value="<?= htmlspecialchars($email)?>" >
        </label>
    </div>

    <div>
        <label>主旨:
            <input type="text" name="subject" placeholder="請輸入主旨" value="<?= htmlspecialchars($subject)?>" >
        </label>
    </div>

    <div>
        <label>內容:
            <textarea name="content" placeholder="請輸入內容"  rows="30" cols="100"  ><?= htmlspecialchars($conect)?></textarea>
        </label>
    </div>
    
    <button type="submit">送出</button>
</form>
<?php require 'includes/footer.php'; ?>