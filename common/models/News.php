<?php

namespace common\models;

use Yii;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $lead
 * @property string $text
 * @property int $image_id
 * @property int $theme_id
 * @property int $rubric_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $slug
 * @property integer $publish
 * @property AuthorNews[] $authorNews
 * @property Author[] $authors
 * @property Image $image
 * @property Rubric $rubric
 * @property Theme $theme
 * @property User $user
 * @property NewsTag[] $newsTags
 * @property Tag[] $tags
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'lead', 'text'], 'required'],
            [['text'], 'string'],
            [['image_id', 'theme_id', 'rubric_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'lead'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 150],
            [['slug'], 'unique',],
            [['title'], 'unique', 'message' => 'Такой заголовок уже был'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['rubric_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubric::className(), 'targetAttribute' => ['rubric_id' => 'id']],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::className(), 'targetAttribute' => ['theme_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['publish', 'integer', 'max' => 1],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                // 'slugAttribute' => 'slug',
            ],

            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
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
            'title' => 'Заголовок',
            'lead' => 'Лид',
            'text' => 'Текст',
            'image_id' => 'Изображение',
            'theme_id' => 'Тема',
            'rubric_id' => 'Рубрика',
            'user_id' => 'User ID',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'slug' => 'В адресной строке',
            'tags' => 'Теги',
<<<<<<< HEAD
            'publish' => 'Опубликовать'
=======
>>>>>>> dev
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorNews()
    {
        return $this->hasMany(AuthorNews::class, ['news_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable('author_news', ['news_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubric()
    {
        return $this->hasOne(Rubric::class, ['id' => 'rubric_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Theme::class, ['id' => 'theme_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getNewsTags()
    {
        return $this->hasMany(NewsTag::class, ['news_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('news_tag', ['news_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    public function beforeValidate()
    {
        $this->user_id = Yii::$app->user->id;
        return parent::beforeValidate();
    }
}
