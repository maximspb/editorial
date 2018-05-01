<?php

namespace backend\models;
use common\models\Tag;
use common\models\ImageTag;


/**
 * Class Image
 * @package backend\models
 * @property  array $tagsList;
 */
class Image extends \common\models\Image
{

    private const SCENARIO_UPDATE = 'update';
    public $tagsList =[];

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = [
            'alt',
            'source',
            'tagsList',

        ];
        return $scenarios;
    }

    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['tagsList'] = 'Теги';
        return $attributeLabels;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['tagsList', 'safe'];
        return $rules;
    }

    /**
     * метод создания превью загруженного изображения
     */
    private function makeThumbnail()
    {
        $thumbnail = \yii\imagine\Image::resize(
            \Yii::getAlias('@img').'/'.$this->filename,
            150, 100
        );
        $thumbnail = \yii\imagine\Image::crop($thumbnail, 150, 100);
        $thumbnail->save(\Yii::getAlias('@img').'/thumbs/'.$this->filename);
    }

    private function setImageToTagsCollation()
    {
        //связь новости с тегами после успешного сохранения новости через связующую модель NewsTag
        if (!empty($this->tagsList)) {
            //если теги заданы через форму, предыдущий список обнуляется
            ImageTag::deleteAll(['image_id' => $this->id]);
            foreach ($this->tagsList as $tagId) {
                $addTagsToImage = new ImageTag();
                $addTagsToImage->image_id = $this->id;

                //при добавлении нового Тега из формы в любом случае приходит строка. Если пришел id сохраненной модели,
                //, берется он. Если же передана строка с  названием нового тега, модели с таким
                //id нет (что очевидно) => создается новый тег, сохраняется в БД и берется его id
                if (Tag::findOne(['id' => $tagId])) {
                    $addTagsToImage->tag_id = $tagId;
                } else {
                    $newTag = new Tag();
                    $newTag->tag_name = $tagId;
                    if ($newTag->save()) {
                        $addTagsToImage->tag_id = $newTag->id;
                    }
                }

                $addTagsToImage->save();
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->makeThumbnail();
        $this->setImageToTagsCollation();
        parent::afterSave($insert, $changedAttributes);
    }
}