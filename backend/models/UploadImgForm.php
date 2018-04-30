<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\Image;


/**
 * @property UploadedFile $imageFile
 * Class UploadImgForm
 * @package backend\models
 */
class UploadImgForm extends Model
{
    /**
     * @var UploadedFile $imageFile
     */
    public $imageFile;
    public $alt;
    public $source;
    public $image_id;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'maxSize' => null],
            ['alt', 'string'],
            ['source', 'string'],
            ['image_id', 'safe']
        ];
    }

    public function uploadFile()
    {
        if ($this->validate()) {

                $nameToSave = $this->imageFile->baseName . '.' .
                               $this->imageFile
                                    ->extension;
                $this->imageFile->saveAs(\Yii::getAlias('@frontend').'/web/images/' . $nameToSave);
                $uploaded = new Image();
                $uploaded->filename = $nameToSave;
                if (!empty($this->alt)){
                    $uploaded->alt = $this->alt;
                }
                if (!empty($this->source)){
                    $uploaded->source = $this->source;
                }
                if ($uploaded->save()){
                 $this->image_id = $uploaded->id;
                }

            return true;
        } else {
            die('AAAAAAAAAAAAAAAAAAAAAAAAAAA!!!');
        }
    }
}