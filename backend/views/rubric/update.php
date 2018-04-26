<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */

$this->title = 'Изменить данные рубрики';
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="rubric-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'themes' => $themes
    ]) ?>

</div>
