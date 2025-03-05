<?php
require 'includes/init.php';
?>

<?php require 'includes/header.php'; ?>

<h2>聯絡我們</h2>
<form method="post">
    <div>
        <label>Email:
            <input type="email" name="email" placeholder="請輸入您的Email" required>
        </label>
    </div>

    <div>
        <label>主旨:
            <input type="text" name="subject" placeholder="請輸入主旨" required>
        </label>
    </div>
    
    <div>
        <label>內容:
            <textarea name="content" placeholder="請輸入內容"  rows="30" cols="100"  required></textarea>
        </label>
    </div>
    
    <button type="submit">送出</button>
</form>
<?php require 'includes/footer.php'; ?>