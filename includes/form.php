<form method="post">
        <!-- 若有錯誤訊息，則顯示 -->
    <?php if(!empty($errors)): ?>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div>
        <!-- 因要練習邏輯需要 先移除前端required來增強後端卡控 -->
        標題:
        <label for="title">
            <!-- 設定Value為$title來保留直 -->
            <input type="text" name="title" id="title" placeholder="Article title" value="<?= $title?>">
        </label>
    </div>
    <br>
    <div>
        內容:
        <label for="content">
            <!-- 設定$content保留直 -->
            <textarea name="content" id="content" rows='10' cols='30' placeholder="Article content"><?= $content?></textarea>
        </label>
    </div>
    <br>
    <div>
        日期:
        <label for="published_at">
            <!-- 因要練習邏輯需要 先移除前端required來增強後端卡控 -->
             <!-- 設定$published_at保留直 -->
            <input type="datetime" name="published_at" id="published_at" value="<?= $published_at?>">
        </label>
    </div>
    <br>

    <div>
        <button>保存</button>
    </div>

    </form>