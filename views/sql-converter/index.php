<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use humhub\modules\content\widgets\richtext\RichText;

$this->pageTitle = 'SQL to HumHub Converter';

$script = <<< JS
// AJAX submission for SQL conversion
$('#sql-converter-form').on('beforeSubmit', function(e) {
    e.preventDefault();

    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json', // Expect JSON response
        success: function(data) {
            if (data.convertedSql !== undefined) {
                $('#converted-sql-container').html('<h3>Converted SQL:</h3><pre>' + data.convertedSql + '</pre>');
            } else if (data.errors !== undefined) {
                alert('Error: ' + data.errors.join(', '));
            } else {
                alert('Error: Unexpected response format.');
            }
        },
        error: function() {
            alert('Error: Unable to process the request.');
        }
    });
});

JS;

$this->registerJsFile('https://code.jquery.com/jquery-3.6.4.min.js');
$this->registerJs($script, View::POS_READY);

$this->title = Yii::t('ConverterModule.base', 'SQL to HumHub Converter');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <title><?= Html::encode($this->title) ?></title>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'sql-converter-form', 'enableAjaxValidation' => true]); ?>

            <?= $form->field($model, 'sqlInput')->textarea(['rows' => 6])->label('Enter SQL Query') ?>

        <div class="form-group">
            <?= Html::submitButton('Convert', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <div id="converted-sql-container">
            <?php if (isset($convertedSql)): ?>
            <h3>Converted SQL:</h3>
            <pre><?= Html::encode($convertedSql) ?></pre>
            <?php endif; ?>
        </div>
        </div>
    </div>
</div>
