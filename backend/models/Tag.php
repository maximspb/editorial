<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class Tag extends \common\models\Tag
{
    /**
     * Метод возвращает массив объектов Image при их наличии либо null
     * @param mixed $tagName
     * @return \common\models\Image[]|null
     */
    public static function findImagesByTagName($tagName)
    {
        $tagName = Html::encode($tagName);
        $possibleTag = Tag::findOne(['tag_name' => $tagName]);
        $taggedImages = $possibleTag->images ?? null;
        return $taggedImages;
    }

    /**
     * Возвращает массив вида id->имя тега,
     * для использования в view
     * @return array
     */
    public static function getMappedFromIdToNameArray()
    {
        return ArrayHelper::map(Tag::find()->all(), 'id', 'tag_name');
    }

}