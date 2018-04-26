<?php

namespace backend\models;

use common\models\AuthorNews;
use common\models\Rubric;

/**
 * Class News
 * @package backend\models
 * @property array $authorsList
 */
class News extends \common\models\News
{

    public $authorsList =[];
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['authorsList'] = 'Список авторов';
        $attributeLabels['user.full_name'] = 'Разместил публикацию';
        $attributeLabels['authors'] = 'Авторы публикации';

        return $attributeLabels;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['authorsList', 'safe'];
        return $rules;
    }

    public function afterSave($insert, $changedAttributes)
    {
        //Проверка на добавление авторов через форму
        if (!empty($this->authorsList)){

            //Если автор(ы) задан(ы), удаляется предыдущий список. Если автор не выбирался, список останется прежним.
            AuthorNews::deleteAll(['news_id' => $this->id]);

            //Добавление выбранных авторов для подписанных публикаций через связующую таблицу
            foreach ($this->authorsList as $authorId){
                $addAuthors = new AuthorNews();
                $addAuthors->author_id = $authorId;
                $addAuthors->news_id = $this->id;
                $addAuthors->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        //Автоматически задается значение атрибута "id Темы", получаем его исходя из выбранной Рубрики
        $this->theme_id = Rubric::findOne(['id' => $this->rubric_id])->theme_id;
        return parent::beforeSave($insert);
    }
}