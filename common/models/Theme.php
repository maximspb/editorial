<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "theme".
 *
 * @property int $id
 * @property string $slug
 * @property string $theme_title
 *
 * @property News[] $news
 * @property Rubric[] $rubrics
 */
class Theme extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_title'], 'required'],
            [['slug', 'theme_title'], 'string', 'max' => 100],
            [['slug'], 'unique'],
            [['theme_title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'В адресной строке',
            'theme_title' => 'Тема',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'theme_title',
                // 'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::class, ['theme_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubrics()
    {
        return $this->hasMany(Rubric::class, ['theme_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ThemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ThemeQuery(get_called_class());
    }
}
