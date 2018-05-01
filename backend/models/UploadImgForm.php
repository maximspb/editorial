<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\Image;


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

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'maxSize' => null],
            ['imageId', 'safe']
        ];
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            $nameToSave = rand(1, 9999) . '_' . $this->imageFile->name;
            $this->imageFile->saveAs(\Yii::getAlias('@img').'/'.$nameToSave);
            $uploaded = new Image();
            $uploaded->filename = $nameToSave;
            if ($uploaded->save()) {
                $this->imageId = $uploaded->id;
            }
            return true;
        } else {
            die('AAAAAAAAAAAAAAAAAAAAAAAAAAA!!!');
        }
    }
}