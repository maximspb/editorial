<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */

$this->title = $model->rubric_title;
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить данные', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удалить эту рубрику?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rubric_title',
            'slug',
            'theme.theme_title',
        ],
    ]) ?>
    <hr>

</div>
<?= GridView::widget([
    'dataProvider' => $newsOfRubric,
    //'filterModel' => $searchModel,
    'options' => ['style' => 'width:90%'],
    'columns' => [
        'title',
        [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'news',
        ],
    ],
]); ?>