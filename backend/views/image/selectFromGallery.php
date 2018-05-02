<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

use yii\widgets\Pjax;

Pjax::begin([]);
$form = ActiveForm::begin([
    'options' => ['data' => ['pjax' => true]],
    'method' => 'get',
    'id' => 'tag_select'
]);

echo $form->field($tag, 'tag_name')->textInput(['name' => 'tagName']); ?>
<div class="form-group">
        <?= Html::submitButton('Выбрать картинки по тегу', ['class' => 'btn-link']) ?>
    </div>
<?php ActiveForm::end();
Pjax::end();

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
        <?= Html::submitButton('Выбрать картинку для публикации', ['class' => 'btn']) ?>
    </div>

<?php ActiveForm::end(); ?>
<?= Html::a('Вернуться', ['/news/view', 'id' => $article->id, 'class' => 'btn']);
