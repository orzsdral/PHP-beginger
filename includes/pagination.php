<?php $base = strtok($_SERVER['REQUEST_URI'],'?'); ?>

<nav>
    <ul class="pagination">
        <?php if($paginator->previous): ?>
            <li class="page-item">
                <a class="page-link" <?= "href={$base}?page={$paginator->previous}"; ?>>上一頁</a>
            </li>
        <?php else: ?>
            <li class="page-link">上一頁</li>
        <?php endif; ?>
        <?php if($paginator->next): ?>
            <li class="page-item">
                <a class="page-link" <?= "href={$base}?page={$paginator->next}"; ?>>下一頁</a>
            </li>
        <?php else: ?>
            <li class="page-link">下一頁</li>
        <?php endif; ?>
        
    </ul>
</nav>