<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubric-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rubric_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'theme_id')->dropDownList($themes) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
