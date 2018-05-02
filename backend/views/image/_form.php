<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tagsList[]')->widget(Select2::class,[
        'data' => $data,
        'maintainOrder' => true,
        'options' => ['multiple' => true,],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10,
        ],
    ])->label((function ($model){
        foreach ($model->tags as $tag) : ?>
            <em><?= Html::a($tag->tag_name.' ,', ['tag/find-tagged-images', 'tagName' => $tag->tag_name]) ?></em>
        <?php endforeach;
    })($model));?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
