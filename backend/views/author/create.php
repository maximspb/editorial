<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Author */

$this->title = 'Добавить автора';
$this->params['breadcrumbs'][] = ['label' => 'Все авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
