<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $slug
 *
 * @property AuthorNews[] $authorNews
 * @property News[] $news
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'email', 'slug'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                // 'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Автор(ы) публикации',
            'email' => 'Email',
            'slug' => 'Имя в адресной строке',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorNews()
    {
        return $this->hasMany(AuthorNews::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['id' => 'news_id'])->viaTable('author_news', ['author_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }
}
