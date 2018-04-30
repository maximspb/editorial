<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ThemeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Главные темы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать тему', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'theme_title',
            'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
