<?php
defined('ENTRY_POINT_USED') || die;
?>
<div class="stories-table">
    <div class="table-title"><?= isset($displayData['error']) ? $displayData['error'] : 'Истории из формы'; ?></div>
    <table cellspacing="0">
        <? require_once $_SERVER['DOCUMENT_ROOT'] . '/application/views/miniadmincontent.php'; ?>
    </table>
</div>
<button class="table-refresh" onclick="ajaxRefresh('<?= $displayData['csrfToken'] ?>')">
    <i class="fa fa-undo" aria-hidden="true"></i>
</button>
