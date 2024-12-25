<?php 
$fruits = ['apple', 'banana', 'orange', 'grape'];

?>
<html>
<head>
    <title>apple</title>
</head>
<body>
    <h1>Fruit</h1>
    <ol>
        <?php foreach($fruits as $fruit): ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ol>
</html>