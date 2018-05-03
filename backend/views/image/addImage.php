<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

$form = ActiveForm::begin(['id' => 'image_upload'])
?>
<?= $form->field($model, 'imageFile')->fileInput()->label('Выбрать файл изображения для загрузки:')  ?>
<?= $form->field($model, 'alt')->textInput(); ?>
<?= $form->field($model, 'source')->textInput(); ?>
<?= $form->field($model, 'tagsList[]')->widget(Select2::class,[
    'data' => $data,
    'maintainOrder' => true,
    'options' => ['multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);
?>
<div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<hr>


