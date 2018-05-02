<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = $model->title;

?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-editorial',
            ],
        ]);


        $menuItems = [
           'image' => [
                'label' => 'Изображение',
                'items' => [
                    [
                            'label' => 'Загрузить новое',
                            'url' => '/image/upload-img-to-article/?id='.$model->id
                    ],
                    [
                            'label' => 'Выбрать из базы',
                            'url' => '/image/select-from-gallery/?id='.$model->id],
                ],
            ],
            'publish' => [
                'label' => 'Публикация',
                'items' => [
                    [
                        'label' => 'Удалить',
                        'url' => Url::to(['delete', 'id' => $model->id]),
                        'linkOptions' => [
                            'data-method' => 'post',
                        ],
                    ],
                    [
                        'label' => 'Редактировать',
                        'url' => Url::to(['update', 'id' => $model->id]),
                    ],
                ],
            ],

        ];

        if (null !== $model->image_id){
            $menuItems['image']['items'][] = [
                    'label' => 'Убрать картинку',
                'url' => '/news/remove-article-image/?id='.$model->id];
        }

       $menuItems[] = (0 ==$model->publish) ?
            [
                'label' => 'Опубликовать',
                'url' => Url::to(['publish', 'id' => $model->id, 'decision' => 1])
            ]:
            [
                'label' => 'Снять с публикации',
                'url' => Url::to(['publish', 'id' => $model->id, 'decision' => 0])
            ];



        echo Nav::widget([
            'options' => ['class' =>'navbar-nav', 'width' => '60%'],
            'items' => $menuItems,
        ]);
        NavBar::end();?>
    </p>
    <?php if (!empty($model->image->filename)) : ?>
        <img src="/images/<?php echo $model->image->filename; ?>" alt="">
    <?php endif; ?>
    <hr>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'lead',
            'text:ntext',
            [
                'attribute' => 'tags',
                'value' => function ($data) {
                    $tags = ArrayHelper::getColumn($data->tags, 'tag_name');
                    $tagsList = implode(', ', $tags);
                    return $tagsList;
                },
            ],
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
        ],
    ]) ?>
</div>
