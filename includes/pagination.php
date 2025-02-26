<?php $base = strtok($_SERVER['REQUEST_URI'],'?'); ?>

<nav>
    <ul>
        <?php if($paginator->previous): ?>
            <li>
                <a <?= "href={$base}?page={$paginator->previous}"; ?>>上一頁</a>
            </li>
        <?php else: ?>
            <li>上一頁</li>
        <?php endif; ?>
        <?php if($paginator->next): ?>
            <li>
                <a <?= "href={$base}?page={$paginator->next}"; ?>>下一頁</a>
            </li>
        <?php else: ?>
            <li>下一頁</li>
        <?php endif; ?>
        
    </ul>
</nav>