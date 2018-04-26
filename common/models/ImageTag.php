<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image_tag".
 *
 * @property int $image_id
 * @property int $tag_id
 *
 * @property Image $image
 * @property Tag $tag
 */
class ImageTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'tag_id'], 'required'],
            [['image_id', 'tag_id'], 'integer'],
            [['image_id', 'tag_id'], 'unique', 'targetAttribute' => ['image_id', 'tag_id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @inheritdoc
     * @return ImageTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImageTagQuery(get_called_class());
    }
}
