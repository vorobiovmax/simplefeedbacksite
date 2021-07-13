<?php
defined('ENTRY_POINT_USED') || die;
?>
<tr class="columns-description">
    <th width="120">Имя</th>
    <th width="70">Пол</th>
    <th width="170">Тип истории</th>
    <th width="155">Публикация</th>
    <th width="240">История</th>
    <th></th>
</tr>
<? $stories = $displayData['stories'] ?? array(); ?>
<? foreach ($stories as $story): ?>
    <tr class="columns-data">
        <td><?= htmlspecialchars($story['name'] ?? null) ?></td>
        <td><?= htmlspecialchars($story['sex'] ?? null) ?></td>
        <td><?= htmlspecialchars($story['type'] ? implode(', ', $story['type']): null) ?></td>
        <td><?= htmlspecialchars($story['publish'] ?? null) ?></td>
        <td><?= htmlspecialchars($story['story'] ?? null) ?></td>
        <td class="controls">
            <div class="columns-action delete" onclick="ajaxDelete(
                <?= htmlspecialchars($story['id'] ?? null) ?>,
                '<?= htmlspecialchars($displayData['csrfToken'] ?? null) ?>'
                )">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <div class="columns-action edit" onclick="moveToFormEditPage(<?= htmlspecialchars($story['id'] ?? null) ?>)">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
        </td>
    </tr>
<? endforeach; ?>
<script src="/scripts/miniadminajax.js"></script>
