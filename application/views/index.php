<?php
defined('ENTRY_POINT_USED') || die;
?>
<form id="feedback" method="post" action="<?= '?' . http_build_query($displayData['formActionParams'] ?? null)?>">
    <?php if(!empty($displayData['formId'])): ?>
        <input type="hidden" name="formId" value="<?= $displayData['formId'] ?>">
    <?php endif; ?>
    <div class="title">
        <span><?= htmlspecialchars($displayData['formTitle'] ?? null)?> </span>
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
        <? if (!empty($displayData['success_message'])): ?>
            <div class="success_block">
                <span>
                    <?= htmlspecialchars($displayData['success_message']) ?>
                </span>
            </div>
            <br/>
        <? endif; ?>
        <div class="input_text_block">
            <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($displayData['text']['name'] ?? null) ?>">
            <textarea name="story" placeholder="Ваша история"><?= htmlspecialchars($displayData['text']['story'] ?? null) ?></textarea>
        </div>
        <div class="input_radio_block">
            <span>
                Пол
            </span>
            <br/>
            <input name="sex" value="male" type="radio" <?= htmlspecialchars($displayData['radio']['male'] ?? null) ?>>
            <span>
                Мужской
            </span>
            <br/>
            <input name="sex" value="female" type="radio" <?= htmlspecialchars($displayData['radio']['female'] ?? null) ?>>
            <span>
                Женский
            </span>
        </div>
        <div class="input_checkbox_block">
            <span>
                Тип истории
            </span>
            <br/>
            <input name="type[]" value="love" type="checkbox" <?= htmlspecialchars($displayData['checkbox']['love'] ?? null) ?>>
            <span>
                Любовная
            </span>
            <br/>
            <input name="type[]" value="war" type="checkbox" <?= htmlspecialchars($displayData['checkbox']['war'] ?? null) ?>>
            <span>
                Военная
            </span>
            <br/>
            <input name="type[]" value="funny" type="checkbox" <?= htmlspecialchars($displayData['checkbox']['funny'] ?? null) ?>>
            <span>
                Веселая
            </span>
        </div>
        <div class="input_droplist_block">
            <span class="placeholder">
                Публикация в:
            </span>
            <select name="publish">
                <option class="feedback__droplist__select__option" value="magazine" <?= htmlspecialchars($displayData['select']['magazine'] ?? null) ?>>
                    Журнал
                </option>
                <option class="feedback__droplist__select__option" value="newspaper" <?= htmlspecialchars($displayData['select']['newspaper'] ?? null) ?>>
                    Газета
                </option>
                <option class="feedback__droplist__select__option" value="book" <?= htmlspecialchars($displayData['select']['book'] ?? null) ?>>
                    Книга
                </option>
            </select>
        </div>
        <br/>
        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($displayData['csrfToken'] ?? null) ?>">
        <div class="input_btn">
            <input type="submit" value="<?= htmlspecialchars($displayData['sendButtonTitle'] ?? '') ?>">
        </div>
        <br/>
        <? if(!empty($displayData['resetButtonNeeded'])): ?>
            <div class="input_btn">
                <input type="reset" value="Сбросить">
            </div>
        <? endif; ?>
    </div>
</form>