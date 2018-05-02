<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = 'Изменить данные изображения:';
$this->params['breadcrumbs'][] = ['label' => 'Картинки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить данные';
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!empty($model->filename)) : ?>
        <img src="/images/<?php echo $model->filename; ?>" alt="">
    <?php endif; ?>
    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
