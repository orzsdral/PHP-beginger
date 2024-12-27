<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        var_dump($_POST);
    }
?>
<?php require_once('includes/header.php'); ?>

<center>
    <h2>New article</h2>    

    <form method="post">

    <div>
        標題:
        <label for="title">
            <input type="text" name="title" id="title" placeholder="Article title" required>
        </label>
    </div>
    <br>
    <div>
        內容:
        <label for="content">
            <textarea name="content" id="content" rows='10' cols='30' placeholder="Article content"></textarea>
        </label>
    </div>
    <br>
    <div>
        日期:
        <label for="published_at">
            <input type="datetime" name="published_at" id="published_at" required>
        </label>
    </div>
    <br>

    <div>
        <button>添加</button>
    </div>

    </form>
</center>

<?php require_once('includes/footer.php'); ?>