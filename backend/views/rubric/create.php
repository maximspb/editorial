<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rubric */

$this->title = 'Создать рубрику';
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'themes' => $themes
    ]) ?>

</div>
