<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Author */

$this->title = 'Обновить данные автора';
$this->params['breadcrumbs'][] = ['label' => 'Все авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
