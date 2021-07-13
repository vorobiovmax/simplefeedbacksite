<?php
defined('ENTRY_POINT_USED') || die;
?>
<form id="login" method="post" action="/login.php">
    <div class="title">
        <span><?= htmlspecialchars($displayData['formTitle'] ?? null) ?></span>
    </div>
    <div class="content">
        <? if (!empty($displayData['errors'])): ?>
            <div class="errors_block">
                <? foreach ($displayData['errors'] as $error): ?>
                    <span>
                        <?= htmlspecialchars($error) ?>
                    </span>
                    <br/>
                <? endforeach; ?>
            </div>
        <? endif; ?>
        <div class="input_text_block">
            <input type="text" name="login" placeholder="Логин" value="<?= htmlspecialchars($displayData['autocompleteLogin'] ?? null) ?>">
            <input type="password" name="password" placeholder="Пароль">
        </div>
        <br/>
        <div class="input_btn">
            <input type="submit" value="Войти">
        </div>
    </div>
    <input type="hidden" name="action" value="login">
</form>