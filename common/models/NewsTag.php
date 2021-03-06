<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_tag".
 *
 * @property int $news_id
 * @property int $tag_id
 *
 * @property News $news
 * @property Tag $tag
 */
class NewsTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'tag_id'], 'required'],
            [['news_id', 'tag_id'], 'integer'],
            [['news_id', 'tag_id'], 'unique', 'targetAttribute' => ['news_id', 'tag_id']],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
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
     * @return NewsTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsTagQuery(get_called_class());
    }
}
