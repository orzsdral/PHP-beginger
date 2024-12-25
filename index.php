<?php
//先硬編模擬資料庫的資料，在此增加陣列內容及可變動顯示的文章
$articles = [
    [
        'title'   => 'First Post', 
        'content' => 'This is the first post'
    ],
    [
        'title'   => 'Second Post', 
        'content' => 'This is the second post'
    ],
    [   
        'title'   => 'Third Post', 
        'content' => 'This is the third post'
    ],
    [
        'title'   => 'Fourth Post', 
        'content' => 'This is the fourth post'
    ]
];
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>
    <!-- 標題 -->
    <header>
        <h1>My Blog</h1>
    </header>
    <!-- 讀取出陣列鍵和值 -->
    <main>
        <ul>
            <?php foreach($articles as $article): ?>
                <li>
                    <h2><?php echo $article['title']; ?></h2>
                    <p><?php echo $article['content']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>