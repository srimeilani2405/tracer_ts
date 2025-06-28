<?= $this->extend('layouts/tracer') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mb-4"><?= esc($title) ?></h2>

    <?php if (!empty($pages)): ?>
        <form method="post" action="<?= site_url('kuesioner/submit/' . $kuesioner['id']) ?>" id="kuesionerForm" class="needs-validation" novalidate>
            <?= csrf_field() ?>

            <!-- Navigation tabs -->
            <ul class="nav nav-tabs mb-4" id="kuesionerTabs" role="tablist">
                <?php foreach ($pages as $index => $page): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $index === 0 ? 'active' : '' ?>"
                            id="tab-<?= $page['id'] ?>"
                            data-bs-toggle="tab"
                            data-bs-target="#page-<?= $page['id'] ?>"
                            type="button"
                            role="tab"
                            <?= $index === 0 ? 'aria-selected="true"' : 'aria-selected="false"' ?>>
                            <?= esc($page['title']) ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="kuesionerContent">
                <?php foreach ($pages as $index => $page): ?>
                    <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                        id="page-<?= $page['id'] ?>"
                        role="tabpanel"
                        aria-labelledby="tab-<?= $page['id'] ?>">

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h3 class="h4"><?= esc($page['title']) ?></h3>
                                <?php if (!empty($page['deskripsi'])): ?>
                                    <p class="mb-0 text-muted"><?= esc($page['deskripsi']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="card-body">
                                <?php if (isset($sections[$page['id']])): ?>
                                    <?php foreach ($sections[$page['id']] as $section): ?>
                                        <div class="mb-4">
                                            <h4 class="h5 border-bottom pb-2 mb-3"><?= esc($section['title']) ?></h4>
                                            <?php if (!empty($section['deskripsi'])): ?>
                                                <p class="text-muted mb-3"><?= esc($section['deskripsi']) ?></p>
                                            <?php endif; ?>

                                            <?php if (isset($fields[$section['id']])): ?>
                                                <div class="question-container">
                                                    <?php foreach ($fields[$section['id']] as $field): ?>
                                                        <?php
                                                        // Build the nested field name structure
                                                        $fieldName = "answers[q_{$kuesioner['id']}][p_{$page['id']}][s_{$section['id']}][id_{$field['id']}]";
                                                        $otherFieldName = "answers[q_{$kuesioner['id']}][p_{$page['id']}][s_{$section['id']}][id_{$field['id']}_other]";

                                                        // Get existing answer if available
                                                        $value = $jawaban["q_{$kuesioner['id']}"]["p_{$page['id']}"]["s_{$section['id']}"]["id_{$field['id']}"]['answer'] ?? '';
                                                        $otherValue = $jawaban["q_{$kuesioner['id']}"]["p_{$page['id']}"]["s_{$section['id']}"]["id_{$field['id']}_other"]['answer'] ?? '';

                                                        // Check if field has "other" option
                                                        $hasOtherOption = false;
                                                        if (!empty($field['options'])) {
                                                            $options = is_string($field['options']) ? json_decode($field['options'], true) : $field['options'];
                                                            foreach ($options as $option) {
                                                                $optValue = is_array($option) ? ($option['value'] ?? null) : $option;
                                                                if ($optValue === 'other' || $optValue === 'Lainnya' || $optValue === 'lainnya') {
                                                                    $hasOtherOption = true;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <div class="question-wrapper form-group mb-4 p-3 bg-white rounded border"
                                                            data-required="<?= $field['required'] ? 'true' : 'false' ?>"
                                                            data-type="<?= esc($field['type']) ?>"
                                                            id="question-<?= $field['id'] ?>">
                                                            <label class="font-weight-bold">
                                                                <?= esc($field['label']) ?>
                                                                <?php if ($field['required']): ?>
                                                                    <span class="text-danger">*</span>
                                                                <?php endif; ?>
                                                            </label>

                                                            <?php if (!empty($field['note'])): ?>
                                                                <small class="form-text text-muted mb-2">
                                                                    <?= esc($field['note']) ?>
                                                                </small>
                                                            <?php endif; ?>

                                                            <!-- Text Input -->
                                                            <?php if ($field['type'] === 'text'): ?>
                                                                <input type="text"
                                                                    name="<?= $fieldName ?>"
                                                                    class="form-control"
                                                                    value="<?= esc($value) ?>"
                                                                    <?= $field['required'] ? 'required' : '' ?>>

                                                            <!-- Number Input -->
                                                            <?php elseif ($field['type'] === 'number'): ?>
                                                                <input type="number"
                                                                    name="<?= $fieldName ?>"
                                                                    class="form-control"
                                                                    value="<?= esc($value) ?>"
                                                                    <?= $field['required'] ? 'required' : '' ?>>

                                                            <!-- Textarea -->
                                                            <?php elseif ($field['type'] === 'textarea'): ?>
                                                                <textarea name="<?= $fieldName ?>"
                                                                    class="form-control"
                                                                    rows="3"
                                                                    <?= $field['required'] ? 'required' : '' ?>><?= esc($value) ?></textarea>

                                                            <!-- Email Input -->
                                                            <?php elseif ($field['type'] === 'email'): ?>
                                                                <input type="email"
                                                                    name="<?= $fieldName ?>"
                                                                    class="form-control email-input"
                                                                    value="<?= esc($value) ?>"
                                                                    <?= $field['required'] ? 'required' : '' ?>>

                                                            <!-- Date Input -->
                                                            <?php elseif ($field['type'] === 'date'): ?>
                                                                <input type="date"
                                                                    name="<?= $fieldName ?>"
                                                                    class="form-control"
                                                                    value="<?= esc($value) ?>"
                                                                    <?= $field['required'] ? 'required' : '' ?>>

                                                            <!-- Dropdown -->
                                                            <?php elseif ($field['type'] === 'dropdown'): ?>
                                                                <?php
                                                                $options = is_string($field['options']) ? json_decode($field['options'], true) : $field['options'];
                                                                ?>
                                                                <select name="<?= $fieldName ?>"
                                                                    class="form-select"
                                                                    <?= $field['required'] ? 'required' : '' ?>
                                                                    data-has-other="<?= $hasOtherOption ? 'true' : 'false' ?>">
                                                                    <option value="">-- Pilih --</option>
                                                                    <?php if (!empty($options)): ?>
                                                                        <?php foreach ($options as $key => $option): ?>
                                                                            <?php
                                                                            $optionValue = is_array($option) ? ($option['value'] ?? $key) : $option;
                                                                            $optionText = is_array($option) ? ($option['label'] ?? $option['value'] ?? $key) : $option;
                                                                            ?>
                                                                            <option value="<?= esc($optionValue) ?>" <?= ($value == $optionValue) ? 'selected' : '' ?>>
                                                                                <?= esc($optionText) ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                                <?php if ($hasOtherOption): ?>
                                                                    <div id="<?= $fieldName ?>_other_container" class="mt-2" style="display: <?= ($value === 'lainnya' || $value === 'Lainnya' || $value === 'other') ? 'block' : 'none'; ?>;">
                                                                        <input type="text"
                                                                            name="<?= $otherFieldName ?>"
                                                                            class="form-control"
                                                                            value="<?= esc($otherValue) ?>"
                                                                            placeholder="Silakan sebutkan"
                                                                            <?= ($field['required'] && ($value === 'lainnya' || $value === 'Lainnya' || $value === 'other')) ? 'required' : '' ?>>
                                                                    </div>
                                                                <?php endif; ?>

                                                            <!-- Radio -->
                                                            <?php elseif ($field['type'] === 'radio'): ?>
                                                                <div class="mt-2">
                                                                    <?php if (!empty($field['options'])): ?>
                                                                        <?php
                                                                        $options = is_string($field['options']) ? json_decode($field['options'], true) : $field['options'];
                                                                        ?>
                                                                        <?php foreach ($options as $key => $option): ?>
                                                                            <?php
                                                                            $optionValue = is_array($option) ? ($option['value'] ?? $key) : $option;
                                                                            $optionText = is_array($option) ? ($option['label'] ?? $option['value'] ?? $key) : $option;
                                                                            $optionId = $fieldName . '_' . preg_replace('/[^a-z0-9]/i', '_', strtolower($optionValue));
                                                                            ?>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio"
                                                                                    name="<?= $fieldName ?>"
                                                                                    id="<?= $optionId ?>"
                                                                                    value="<?= esc($optionValue) ?>"
                                                                                    <?= ($value == $optionValue) ? 'checked' : '' ?>
                                                                                    <?= $field['required'] ? 'required' : '' ?>
                                                                                    data-has-other="<?= ($optionValue === 'lainnya' || $optionValue === 'Lainnya' || $optionValue === 'other') ? 'true' : 'false' ?>">
                                                                                <label class="form-check-label" for="<?= $optionId ?>">
                                                                                    <?= esc($optionText) ?>
                                                                                </label>
                                                                            </div>
                                                                            <?php if (($optionValue === 'lainnya' || $optionValue === 'Lainnya' || $optionValue === 'other') && $hasOtherOption): ?>
                                                                                <div id="<?= $fieldName ?>_other_container" class="mt-2 ms-4" style="display: <?= ($value === 'lainnya' || $value === 'Lainnya' || $value === 'other') ? 'block' : 'none'; ?>;">
                                                                                    <input type="text"
                                                                                        name="<?= $otherFieldName ?>"
                                                                                        class="form-control"
                                                                                        value="<?= esc($otherValue) ?>"
                                                                                        placeholder="Silakan sebutkan"
                                                                                        <?= ($field['required'] && ($value === 'lainnya' || $value === 'Lainnya' || $value === 'other')) ? 'required' : '' ?>>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </div>

                                                            <!-- Checkbox -->
                                                            <?php elseif ($field['type'] === 'checkbox'): ?>
                                                                <div class="mt-2">
                                                                    <?php if (!empty($field['options'])): ?>
                                                                        <?php
                                                                        $options = is_string($field['options']) ? json_decode($field['options'], true) : $field['options'];
                                                                        $valueArray = is_array($value) ? $value : [];
                                                                        ?>
                                                                        <?php foreach ($options as $key => $option): ?>
                                                                            <?php
                                                                            $optionValue = is_array($option) ? ($option['value'] ?? $key) : $option;
                                                                            $optionText = is_array($option) ? ($option['label'] ?? $option['value'] ?? $key) : $option;
                                                                            $optionId = $fieldName . '_' . preg_replace('/[^a-z0-9]/i', '_', strtolower($optionValue));
                                                                            ?>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    name="<?= $fieldName ?>[]"
                                                                                    id="<?= $optionId ?>"
                                                                                    value="<?= esc($optionValue) ?>"
                                                                                    <?= in_array($optionValue, $valueArray) ? 'checked' : '' ?>
                                                                                    data-has-other="<?= ($optionValue === 'lainnya' || $optionValue === 'Lainnya' || $optionValue === 'other') ? 'true' : 'false' ?>">
                                                                                <label class="form-check-label" for="<?= $optionId ?>">
                                                                                    <?= esc($optionText) ?>
                                                                                </label>
                                                                            </div>
                                                                            <?php if (($optionValue === 'lainnya' || $optionValue === 'Lainnya' || $optionValue === 'other') && $hasOtherOption): ?>
                                                                                <div id="<?= $fieldName ?>_other_container" class="mt-2 ms-4" style="display: <?= in_array('lainnya', $valueArray) || in_array('Lainnya', $valueArray) || in_array('other', $valueArray) ? 'block' : 'none'; ?>;">
                                                                                    <input type="text"
                                                                                        name="<?= $otherFieldName ?>"
                                                                                        class="form-control"
                                                                                        value="<?= esc($otherValue) ?>"
                                                                                        placeholder="Silakan sebutkan"
                                                                                        <?= ($field['required'] && (in_array('lainnya', $valueArray) || in_array('Lainnya', $valueArray) || in_array('other', $valueArray))) ? 'required' : '' ?>>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </div>

                                                            <!-- Scale Input -->
                                                            <?php elseif ($field['type'] === 'scale'): ?>
                                                                <?php
                                                                $options = is_string($field['options']) ? json_decode($field['options'], true) : $field['options'];
                                                                $min = $options['min'] ?? 1;
                                                                $max = $options['max'] ?? 5;
                                                                $labels = $options['labels'] ?? [];
                                                                ?>
                                                                <div class="scale-scroll">
                                                                    <div class="scale-inline">
                                                                        <?php for ($i = $min; $i <= $max; $i++): ?>
                                                                            <?php $label = $labels[$i - $min] ?? $i; ?>
                                                                            <div class="scale-option">
                                                                                <input type="radio"
                                                                                    name="<?= $fieldName ?>"
                                                                                    id="<?= $fieldName ?>_<?= $i ?>"
                                                                                    value="<?= esc($label) ?>"
                                                                                    class="form-check-input mb-1"
                                                                                    <?= ($value == $label) ? 'checked' : '' ?>
                                                                                    <?= $field['required'] ? 'required' : '' ?>>
                                                                                <div><label for="<?= $fieldName ?>_<?= $i ?>"><?= esc($label) ?></label></div>
                                                                            </div>
                                                                        <?php endfor; ?>
                                                                    </div>
                                                                </div>

                                                            <!-- Grid Input -->
                                                            <?php elseif ($field['type'] === 'grid'): ?>
                                                                <?php
                                                                $options = is_string($field['options']) ? json_decode($field['options'], true) : $field['options'];
                                                                $rows = $options['rows'] ?? [];
                                                                $columns = $options['columns'] ?? [];
                                                                $gridValues = is_array($value) ? $value : [];
                                                                ?>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered grid-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Skala Penilaian</th>
                                                                                <?php for ($i = 1; $i <= count($columns); $i++): ?>
                                                                                    <th>
                                                                                        <?= $i ?><br>
                                                                                        <small class="text-muted">
                                                                                            <?php 
                                                                                            switch($i) {
                                                                                                case 1: echo 'Sangat Kurang'; break;
                                                                                                case 2: echo 'Kurang'; break;
                                                                                                case 3: echo 'Cukup'; break;
                                                                                                case 4: echo 'Baik'; break;
                                                                                                case 5: echo 'Sangat Baik'; break;
                                                                                                default: echo '';
                                                                                            }
                                                                                            ?>
                                                                                        </small>
                                                                                    </th>
                                                                                <?php endfor; ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($rows as $rowIndex => $row): ?>
                                                                                <tr>
                                                                                    <td><?= esc($row) ?></td>
                                                                                    <?php foreach ($columns as $colIndex => $col): ?>
                                                                                        <td>
                                                                                            <input type="radio"
                                                                                                name="<?= $fieldName ?>[<?= $rowIndex ?>]"
                                                                                                value="<?= esc($col) ?>"
                                                                                                <?= (isset($gridValues[$rowIndex]) && $gridValues[$rowIndex] === $col) ? 'checked' : '' ?>
                                                                                                <?= $field['required'] ? 'required' : '' ?>
                                                                                                class="form-check-input">
                                                                                        </td>
                                                                                    <?php endforeach; ?>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            <!-- Phone Input -->
                                                            <?php elseif ($field['type'] === 'phone' || $field['type'] === 'telepon'): ?>
                                                                <input type="tel"
                                                                    name="<?= $fieldName ?>"
                                                                    class="form-control phone-input"
                                                                    value="<?= esc($value) ?>"
                                                                    pattern="[0-9]*"
                                                                    inputmode="numeric"
                                                                    <?= $field['required'] ? 'required' : '' ?>>

                                                            <!-- User Field (readonly) -->
                                                            <?php elseif ($field['type'] === 'user_field'): ?>
                                                                <?php
                                                                $userField = !empty($field['options'][0]) ? $field['options'][0] : '';
                                                                $userValue = '';

                                                                if ($userField && session()->has($userField)) {
                                                                    $userValue = session()->get($userField);
                                                                } elseif ($userField && isset($userData[$userField])) {
                                                                    $userValue = $userData[$userField];
                                                                }
                                                                ?>
                                                                <input type="text"
                                                                    name="<?= $fieldName ?>"
                                                                    class="form-control"
                                                                    value="<?= esc($userValue) ?>"
                                                                    readonly>
                                                            <?php endif; ?>

                                                            <!-- Error messages -->
                                                            <div class="error-message text-danger small mt-2" style="display: none;">
                                                                Pertanyaan ini wajib diisi.
                                                            </div>
                                                            <div class="email-error-message text-danger small mt-2" style="display: none;">
                                                                Format email tidak valid.
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Navigation buttons -->
                        <div class="d-flex justify-content-between mb-4">
                            <?php if ($index > 0): ?>
                                <button type="button" class="btn btn-secondary prev-page" data-target="#tab-<?= $pages[$index - 1]['id'] ?>">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>

                            <?php if ($index < count($pages) - 1): ?>
                                <button type="button" class="btn btn-primary next-page" 
                                    data-current-page="<?= $page['id'] ?>" 
                                    data-target="#tab-<?= $pages[$index + 1]['id'] ?>">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Submit Kuesioner
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">
            Kuesioner ini belum memiliki pertanyaan.
        </div>
    <?php endif; ?>
</div>

<style>
    .question-container {
        display: grid;
        gap: 1.5rem;
    }

    .nav-tabs .nav-link {
        color: #495057;
    }

    .nav-tabs .nav-link.active {
        font-weight: bold;
        color: #0d6efd;
    }

    .form-check {
        margin-bottom: 0.5rem;
    }

    .scale-scroll {
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .scale-inline {
        display: flex;
        gap: 20px;
        align-items: center;
        white-space: nowrap;
    }

    .scale-inline .scale-option {
        text-align: center;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
    }

    .question-wrapper.is-invalid {
        border-color: #dc3545 !important;
    }

    /* Style khusus untuk grid */
    .grid-table th, .grid-table td {
        text-align: center;
        vertical-align: middle;
    }
    .grid-table th {
        background-color: #f8f9fa;
    }
    .grid-table td {
        padding: 10px;
    }
    .grid-table input[type="radio"] {
        margin: 0 auto;
        display: block;
    }
    .grid-table small {
        font-size: 0.8em;
        display: block;
        margin-top: 3px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kuesionerId = <?= $kuesioner['id'] ?? 0 ?>;
        let saveTimeout;
        let isSubmitting = false;

        // Initialize Bootstrap tabs
        const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabEls.forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', function(event) {
                window.scrollTo(0, 0);
            });
        });

        // Navigation between tabs
        document.querySelectorAll('.next-page').forEach(button => {
            button.addEventListener('click', function() {
                const currentPageId = this.getAttribute('data-current-page');
                const targetTab = this.getAttribute('data-target');
                
                // Validate current page before switching
                if (validatePage(currentPageId)) {
                    const tab = document.querySelector(targetTab);
                    if (tab) {
                        bootstrap.Tab.getOrCreateInstance(tab).show();
                    }
                }
            });
        });

        document.querySelectorAll('.prev-page').forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-target');
                const tab = document.querySelector(targetTab);
                if (tab) {
                    bootstrap.Tab.getOrCreateInstance(tab).show();
                }
            });
        });

        // Function to collect all answers from the form
        function collectAnswers() {
            const formData = new FormData(document.getElementById('kuesionerForm'));
            const answers = {};

            // Build the nested answers structure
            formData.forEach((value, key) => {
                if (key.startsWith('answers')) {
                    const path = key.replace(/answers\[([^\]]+)\]/g, '$1').split('][');
                    let current = answers;

                    for (let i = 0; i < path.length - 1; i++) {
                        const part = path[i].replace(/[\[\]]/g, '');
                        current[part] = current[part] || {};
                        current = current[part];
                    }

                    const lastPart = path[path.length - 1].replace(/[\[\]]/g, '');
                    current[lastPart] = value;
                }
            });

            return answers;
        }

        // Auto-save functionality
        function autoSaveAnswers() {
            if (isSubmitting) return;

            const answers = collectAnswers();

            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(() => {
                fetch(`/kuesioner/autosave/${kuesionerId}`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            answers: answers
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error('Gagal menyimpan draft:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }, 1000);
        }

        // Set up event listeners for auto-save
        document.querySelectorAll('input, select, textarea').forEach(field => {
            if (field.type !== 'button' && field.type !== 'submit') {
                field.addEventListener('change', autoSaveAnswers);

                if (field.type === 'text' || field.type === 'textarea') {
                    field.addEventListener('input', autoSaveAnswers);
                }
            }
        });

        // Handle "other" option visibility
        function handleOtherOptionVisibility(field) {
            const fieldName = field.name;
            const isOtherSelected = 
                (field.type === 'radio' && (field.value === 'lainnya' || field.value === 'Lainnya' || field.value === 'other') && field.checked) ||
                (field.type === 'checkbox' && (field.value === 'lainnya' || field.value === 'Lainnya' || field.value === 'other') && field.checked) ||
                (field.type === 'select-one' && (field.value === 'lainnya' || field.value === 'Lainnya' || field.value === 'other'));

            const otherContainer = document.getElementById(`${fieldName}_other_container`);
            if (otherContainer) {
                otherContainer.style.display = isOtherSelected ? 'block' : 'none';
                
                // Handle required attribute for other text input
                const otherInput = otherContainer.querySelector('input[type="text"]');
                if (otherInput) {
                    const isRequired = field.closest('.question-wrapper').dataset.required === 'true';
                    otherInput.required = isOtherSelected && isRequired;
                }
            }
        }

        // Initialize other option visibility
        document.querySelectorAll('input[type="radio"], input[type="checkbox"], select').forEach(field => {
            if (field.getAttribute('data-has-other') === 'true' || 
                field.value === 'lainnya' || 
                field.value === 'Lainnya' || 
                field.value === 'other' ||
                (field.options && (field.options[field.selectedIndex]?.value === 'lainnya' || 
                                   field.options[field.selectedIndex]?.value === 'Lainnya' || 
                                   field.options[field.selectedIndex]?.value === 'other'))) {
                handleOtherOptionVisibility(field);
            }

            field.addEventListener('change', function() {
                handleOtherOptionVisibility(this);
            });
        });

        // Phone input validation: only numbers
        document.querySelectorAll('.phone-input').forEach(input => {
            // Filter non-numeric characters on input
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
            
            // Block non-numeric characters while typing
            input.addEventListener('keydown', function(e) {
                // Allow: numbers (0-9), backspace, delete, tab, arrow keys
                const allowedKeys = [8, 9, 37, 38, 39, 40, 46]; // Key codes for controls
                
                if (!(
                    (e.key >= '0' && e.key <= '9') || 
                    allowedKeys.includes(e.keyCode)
                )) {
                    e.preventDefault();
                }
            });
        });

        // Function to validate a single page
        function validatePage(pageId) {
            let isValid = true;
            let firstInvalidField = null;

            // Get all questions on this page
            const pageElement = document.getElementById(`page-${pageId}`);
            if (!pageElement) return false;

            // Reset error state on this page
            pageElement.querySelectorAll('.question-wrapper').forEach(q => {
                q.classList.remove('is-invalid');
                q.querySelector('.error-message').style.display = 'none';
                q.querySelector('.email-error-message').style.display = 'none';
            });

            // Validate each field on the page
            const questions = pageElement.querySelectorAll('.question-wrapper');
            questions.forEach(q => {
                const inputs = q.querySelectorAll('input, select, textarea');
                const isRequired = q.dataset.required === "true";
                const type = q.dataset.type;
                let valueFilled = false;
                let invalidEmail = false;

                // Special handling for grid type
                if (type === 'grid') {
                    const radios = q.querySelectorAll('input[type="radio"]');
                    const checkedRowNames = new Set();
                    
                    radios.forEach(radio => {
                        if (radio.checked) {
                            checkedRowNames.add(radio.name);
                        }
                    });
                    
                    // Assume number of rows equals unique names count
                    valueFilled = (checkedRowNames.size > 0);
                    
                    // If required, ensure all rows are filled
                    if (isRequired && checkedRowNames.size < q.querySelectorAll('tbody tr').length) {
                        valueFilled = false;
                    }
                } else {
                    inputs.forEach(input => {
                        // Skip hidden inputs and disabled fields
                        if (input.type === 'hidden' || input.disabled) return;

                        const val = input.value?.trim();
                        const isChecked = input.type === 'checkbox' || input.type === 'radio' ? input.checked : false;

                        if (input.type === 'checkbox' || input.type === 'radio') {
                            if (isChecked) valueFilled = true;
                        } else if (val) {
                            valueFilled = true;
                            if (type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
                                invalidEmail = true;
                            }
                        }
                    });
                }

                let hasError = false;

                // Check required fields
                if (isRequired && !valueFilled) {
                    hasError = true;
                    q.querySelector('.error-message').style.display = 'block';
                }

                // Check email format
                if (type === 'email' && valueFilled && invalidEmail) {
                    hasError = true;
                    q.querySelector('.email-error-message').style.display = 'block';
                }

                // Set invalid state
                if (hasError) {
                    q.classList.add('is-invalid');
                    if (!firstInvalidField) {
                        firstInvalidField = q;
                    }
                    isValid = false;
                }
            });

            if (!isValid && firstInvalidField) {
                firstInvalidField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            return isValid;
        }

        // Final form validation on submit
        const form = document.getElementById('kuesionerForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                isSubmitting = true;
                let isValid = true;
                let firstInvalidField = null;

                // Validate all pages
                const pages = document.querySelectorAll('.tab-pane');
                pages.forEach(page => {
                    const pageId = page.id.replace('page-', '');
                    if (!validatePage(pageId)) {
                        isValid = false;
                        
                        // Find the first tab with error
                        if (!firstInvalidField) {
                            firstInvalidField = document.querySelector(`#tab-${pageId}`);
                        }
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    isSubmitting = false;

                    // Show the first tab with error
                    if (firstInvalidField) {
                        bootstrap.Tab.getOrCreateInstance(firstInvalidField).show();
                    }
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>