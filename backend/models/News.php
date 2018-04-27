<?php

namespace backend\models;

use common\models\AuthorNews;
use common\models\NewsTag;
use common\models\Rubric;
use common\models\Tag;

/**
 * Class News
 * @package backend\models
 * @property array $authorsList
 * @property  array $tagsList;
 */
class News extends \common\models\News
{

    public $authorsList = [];
    public $tagsList = [];

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
        $rules[] = ['tagsList', 'safe'];
        return $rules;
    }


    public function afterSave($insert, $changedAttributes)
    {
        //Проверка на добавление авторов через форму
        if (!empty($this->authorsList)) {

            //Если автор(ы) задан(ы), удаляется предыдущий список. Если автор не выбирался, список останется прежним.
            AuthorNews::deleteAll(['news_id' => $this->id]);

            //Добавление выбранных авторов для подписанных публикаций через связующую таблицу
            foreach ($this->authorsList as $authorId) {
                $addAuthors = new AuthorNews();
                $addAuthors->author_id = $authorId;
                $addAuthors->news_id = $this->id;
                $addAuthors->save();
            }
        }

        //связь новости с тегами после успешного сохранения новости через связующую модель NewsTag
        if (!empty($this->tagsList)) {
            //если теги заданы через форму, предыдущий список обнуляется
            NewsTag::deleteAll(['news_id' => $this->id]);
            foreach ($this->tagsList as $tagId) {
                $addTagsToArticle = new NewsTag();
                $addTagsToArticle->news_id = $this->id;

                //при добавлении нового Тега из формы в любом случае приходит строка. Если пришел id сохраненной модели,
                //, берется он. Если же передана строка с  названием нового тега, модели с таким
                //id нет (что очевидно) => создается новый тег, сохраняется в БД и берется его id
                if (Tag::findOne(['id' => $tagId])) {
                    $addTagsToArticle->tag_id = $tagId;
                } else {
                    $newTag = new Tag();
                    $newTag->tag_name = $tagId;
                    if ($newTag->save()) {
                        $addTagsToArticle->tag_id = $newTag->id;
                    }
                }

                $addTagsToArticle->save();
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

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }
}