<div class="navigation">
<?php if ($page > 1) { ?>
    <a href="?page=<?= $page - 1; ?>"><img src="/images/prev.png"/></a>
<?php } ?>
<?php if ($page < $nbPages) { ?>
    <a href="?page=<?= $page + 1; ?>"><img src="/images/next.png"/></a>
<?php } ?>
</div>