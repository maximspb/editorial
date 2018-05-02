<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$nonPublishedNews =[];
foreach ($notPublished as $article) :
    $nonPublishedNews[] = Html::a($article->title, ['view', 'id' => $article->id]);
endforeach;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo Collapse::widget([
        'items' => [
            [
                'label' => 'Список не опубликованных',
                'content' => $nonPublishedNews,
                'contentOptions' => [],
                'options' => []
            ],
        ]
    ]);
    ;?>
    <p>
        <?= Html::a('Добавить публикацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'width:99%'],
        'columns' => [
            'title',
            'rubric.rubric_title',
            'user.full_name',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
