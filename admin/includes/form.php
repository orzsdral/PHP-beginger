<form method="post" id="formArticle">
        <!-- 若有錯誤訊息，則顯示 -->
    <?php if(!empty($article->errors)): ?>
        <ul>
            <?php foreach($article->errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="form-group">
        <!-- 因要練習邏輯需要 先移除前端required來增強後端卡控 -->
        標題:
        <label for="title">
            <!-- 設定Value為$title來保留直 -->
            <input class="form-control" type="text" name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($article->title)?>">
        </label>
    </div>
    <br>
    <div class="form-group">
        內容:
        <label for="content">
            <!-- 設定$content保留直 -->
            <textarea class="form-control" name="content" id="content" rows='10' cols='30' placeholder="Article content"><?= htmlspecialchars($article->content)?></textarea>
        </label>
    </div>
    <br>
    <div class="form-group">
        日期:
        <label for="published_at">
            <!-- 因要練習邏輯需要 先移除前端required來增強後端卡控 -->
             <!-- 設定$published_at保留直 -->
            <input class="form-control" name="published_at" id="published_at" value="<?= htmlspecialchars($article->published_at)?>">
        </label>
    </div>
    <br>
    <fieldset>
        <legend>Category</legend>
        <?php foreach($categories as $category): ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="category[]" value="<?= $category['id'] ?>" id="category<?= $category['id'] ?>"
                <?php if(in_array($category['id'], $category_ids)) echo 'checked'; ?>>
                <label class="form-check-label" for="category<?= $category['id']?>"><?= htmlspecialchars($category['name'])?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>


    <div>
        <button>保存</button>
    </div>

    </form>