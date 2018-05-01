<?php

namespace backend\controllers;

use backend\models\News;
use Yii;
use backend\models\Image;
use backend\models\UploadImgForm;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\data\Sort;
use common\models\Tag;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends AdminBaseController
{


    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $images = Image::find();

        $count = $images->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = 10;

        $sort = new Sort([
            'attributes' => [
                'created_at',
            ]
        ]);
        $models = $images->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy($sort->orders)
            ->all();
        return $this->render('index', [
            'models' => $models,
            'sort' => $sort,
            'pages' => $pagination
        ]);
    }


    public function actionAddImage()
    {
        $model = new UploadImgForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->uploadFile()) {
                    return $this->redirect(['index']);
                }
        }
        return $this->render('addImage', [
            'model' => $model,
        ]);

    }

    public function actionSelectFromGallery($id)
    {
        $article = News::findOne(['id' => $id]);
        $images = Image::find()->orderBy('id')->all();
        if ($article->load(Yii::$app->request->post()) && $article->save()){
            return $this->redirect(['news/view', 'id' => $id]);
        }
        return $this->render('selectFromGallery', [
            'article' => $article, 'images' => $images
        ]);
    }


    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = ArrayHelper::map(Tag::find()->all(), 'id', 'tag_name');;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
