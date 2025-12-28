<form method="post" action="<?=htmlspecialchars($action)?>" class="wish-form">
    <input type="hidden" name="csrf_token" value="<?=htmlspecialchars(csrf_token())?>">
    <label>Что хочется:
        <input type="text" name="title" required maxlength="255" value="<?=htmlspecialchars($titleVal ?? '')?>">
    </label>
    <label>Описание (опционально):
        <textarea name="description"><?=htmlspecialchars($descVal ?? '')?></textarea>
    </label>
    <label class="row">
        <input type="checkbox" name="is_public" value="1" <?=(!empty($isPublic) ? 'checked' : '')?>> Публичное (видно другим)
    </label>
    <div class="form-actions">
        <button type="submit" class="btn">Сохранить</button>
    </div>
</form>
