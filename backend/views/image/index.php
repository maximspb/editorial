<?php

use yii\bootstrap\Html;
use yii\widgets\LinkPager;

?>
<p><?=$sort->link('created_at')?></p>
<div class="container">
<div class="my-flex-container">
<?php foreach ($models as $model): ?>
    <div class="my-flex-block">
        <a href=""><img src="/images/thumbs/<?=$model->filename ?>" class="img-fluid img-thumbnail" alt=""></a><br>
        <br>
        <?= Html::a('Обновить данные', ['image/update', 'id' => $model->id]) ?>
    </div>
<?php endforeach ?>
</div>
</div>
<?=LinkPager::widget([
    'pagination' => $pages
]);
