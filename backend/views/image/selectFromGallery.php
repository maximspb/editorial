<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(['id' => 'gallery']); ?>
    <div class="container">
    <div class="my-flex-container">

        <?php foreach ($images as $image) :?>

            <div class="my-flex-block">
                <a href="/images/<?=$image->filename ?>"><img src="/images/thumbs/<?=$image->filename ?>" alt=""></a>
                <br>
                <?= Html::a('добавить данные', ['update', 'id' => $image->id]) ?>
                <br>
                <?= $form->field($article, 'image_id')->radio([
                    'value' => $image->id,
                    'uncheck' => null,
                    'label' => 'Выбрать']) ?>
            </div>

        <?php endforeach; ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Выбрать картинку для публикации', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>