<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

$form = ActiveForm::begin()
?>
<?= $form->field($model, 'imageFile')->fileInput()->label('Выбрать файл изображения для загрузки:')  ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<hr>


