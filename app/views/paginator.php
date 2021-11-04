    <ul class="pagination">
        <?php if ($paginator->getPrevUrl()): ?>
        <li><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo; Previous</a></li>
    <?php endif; ?>

    <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
            <li <?php echo $page['isCurrent'] ? 'class="page-item active"' : ''; ?>>
                <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled"><span><?php echo $page['num']; ?></span></li>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($paginator->getNextUrl()): ?>
        <li><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">Next &raquo;</a></li>
    <?php endif; ?>
    <form class="pagination"  action="/" method="GET">
        <input type="number" min="1" max="100" name="showBy" value="<?= $showBy ?>">
    </form>
</ul>

