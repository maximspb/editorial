<?php

namespace common\models;


/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $filename
 * @property string $alt
 * @property string $source
 * @property ImageTag[] $imageTags
 * @property Tag[] $tags
 * @property News[] $news
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'alt', 'source'], 'string', 'max' => 100],
            [['filename'], 'unique'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Имя файла',
            'alt' => 'Описание',
            'source' => 'Источник изображения',
            'created_at' => 'Добавлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageTags()
    {
        return $this->hasMany(ImageTag::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('image_tag', ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['image_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImageQuery(get_called_class());
    }
}
