<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить публикацию', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить публикацию', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удалить эту публикацию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'lead',
            'text:ntext',
            'theme.theme_title',
            'rubric.rubric_title',
            'user.full_name',
            [
                'attribute' => 'authors',
                'value' => function ($data) {
                    $authors = ArrayHelper::getColumn($data->authors, 'name');
                    $authorsList = implode(', ', $authors);
                    return $authorsList;
                },
            ],
            'created_at',
            'updated_at',
            'slug',
        ],
    ]) ?>
</div>
