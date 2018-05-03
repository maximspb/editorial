<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * @property UploadedFile $imageFile
 * @property string $alt
 * Class UploadImgForm
 * @package backend\models
 */
class UploadImgForm extends Model
{
    /**
     * @var UploadedFile $imageFile
     */
    public $imageFile;
    public $imageId;
    public $alt;
    public $source;
    public $tagsList =[];

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'maxSize' => null],
            [['alt', 'tagsList', 'imageId', 'source'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'alt' => 'Описание',
            'source' => 'Источник изображения',
            'tagsList' => 'Теги'

        ];
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            $nameToSave = rand(1, 9999) . '_' . $this->imageFile->name;
            $this->imageFile->saveAs(\Yii::getAlias('@img').'/'.$nameToSave);
            $uploaded = new Image();
            $uploaded->filename = $nameToSave;
            $uploaded->alt = $this->alt;
            $uploaded->source = $this->source;
            $uploaded->tagsList = $this->tagsList;
            if ($uploaded->save()) {
                $this->imageId = $uploaded->id;
            }
            return true;
        } else {
            throw new \Exception();
        }
    }
}