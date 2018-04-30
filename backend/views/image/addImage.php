<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$form = ActiveForm::begin()
?>
<?= $form->field($model, 'imageFile')->fileInput()->label('Выбрать файл изображения для загрузки:')  ?>

<?= $form->field($model, 'alt')->textInput() ?>
<?= $form->field($model, 'source')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>