<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author_news".
 *
 * @property int $author_id
 * @property int $news_id
 *
 * @property Author $author
 * @property News $news
 */
class AuthorNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'news_id'], 'required'],
            [['author_id', 'news_id'], 'integer'],
            [['author_id', 'news_id'], 'unique', 'targetAttribute' => ['author_id', 'news_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Author ID',
            'news_id' => 'News ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::class, ['id' => 'news_id']);
    }

    /**
     * @inheritdoc
     * @return AuthorNewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorNewsQuery(get_called_class());
    }
}
