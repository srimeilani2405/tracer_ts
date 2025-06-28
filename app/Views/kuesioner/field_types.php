<input type="text" 
       name="field_<?= $field['id'] ?>" 
       id="field_<?= $field['id'] ?>" 
       class="form-control" 
       <?= $field['required'] ? 'required' : '' ?>>

       <textarea name="field_<?= $field['id'] ?>" 
          id="field_<?= $field['id'] ?>" 
          class="form-control" 
          rows="3"
          <?= $field['required'] ? 'required' : '' ?>></textarea>

          <?php foreach ($field['options'] as $option): ?>
    <div class="form-check">
        <input class="form-check-input" 
               type="radio" 
               name="field_<?= $field['id'] ?>" 
               id="field_<?= $field['id'] ?>_<?= url_title($option) ?>" 
               value="<?= $option ?>"
               <?= $field['required'] ? 'required' : '' ?>>
        <label class="form-check-label" for="field_<?= $field['id'] ?>_<?= url_title($option) ?>">
            <?= $option ?>
        </label>
    </div>
<?php endforeach; ?>

<?php foreach ($field['options'] as $option): ?>
    <div class="form-check">
        <input class="form-check-input" 
               type="checkbox" 
               name="field_<?= $field['id'] ?>[]" 
               id="field_<?= $field['id'] ?>_<?= url_title($option) ?>" 
               value="<?= $option ?>">
        <label class="form-check-label" for="field_<?= $field['id'] ?>_<?= url_title($option) ?>">
            <?= $option ?>
        </label>
    </div>
<?php endforeach; ?>

<select name="field_<?= $field['id'] ?>" 
        id="field_<?= $field['id'] ?>" 
        class="form-control"
        <?= $field['required'] ? 'required' : '' ?>>
    <option value="">-- Pilih --</option>
    <?php foreach ($field['options'] as $option): ?>
        <option value="<?= $option ?>"><?= $option ?></option>
    <?php endforeach; ?>
</select>

<div class="scale-container">
    <div class="scale-labels d-flex justify-content-between mb-2">
        <?php if (!empty($field['start_label'])): ?>
            <span><?= $field['start_label'] ?></span>
        <?php endif; ?>
        
        <?php if (!empty($field['middle_label'])): ?>
            <span><?= $field['middle_label'] ?></span>
        <?php endif; ?>
        
        <?php if (!empty($field['end_label'])): ?>
            <span><?= $field['end_label'] ?></span>
        <?php endif; ?>
    </div>
    
    <div class="scale-options d-flex justify-content-between">
        <?php for ($i = $field['scale_min']; $i <= $field['scale_max']; $i++): ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                       type="radio" 
                       name="field_<?= $field['id'] ?>" 
                       id="field_<?= $field['id'] ?>_<?= $i ?>" 
                       value="<?= $i ?>"
                       <?= $field['required'] ? 'required' : '' ?>>
                <label class="form-check-label" for="field_<?= $field['id'] ?>_<?= $i ?>">
                    <?= $i ?>
                </label>
            </div>
        <?php endfor; ?>
    </div>
</div>

