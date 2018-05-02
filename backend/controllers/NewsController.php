<?php

namespace backend\controllers;

use common\models\Author;
use common\models\Rubric;
use common\models\Tag;
use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class NewsController extends AdminBaseController
{


    /**
     * Все новости.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $notPublished = News::getAllNotPublished();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notPublished' => $notPublished
        ]);
    }

    /**
     * Отображение конкретной новости.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $authors = ArrayHelper::getColumn($model->authors, 'name');
        return $this->render('view', [
            'model' => $model,
            'authors' => $authors,
        ]);
    }

    /**
     * Добавление новости
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $allTags = ArrayHelper::map(Tag::find()->all(), 'id', 'tag_name');

        //получение списка авторов для дальнейшей связи их с новостью
        $authorsList = ArrayHelper::map(Author::find()->all(), 'id','name');

        //получение списка рубрик в формате id => название. В post-запрос передается id
        $rubrics = ArrayHelper::map(Rubric::find()->all(), 'id', 'rubric_title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'rubrics' => $rubrics,
            'authorsList' => $authorsList,
            'data' => $allTags
        ]);
    }



    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $allTags = ArrayHelper::map(Tag::find()->all(), 'id', 'tag_name');

        //получения списка авторов для дальнейшей связи их с новостью
        $authorsList = ArrayHelper::map(Author::find()->all(), 'id', 'name');

        //Массив id и названий Рубрик
        $rubrics = ArrayHelper::map(Rubric::find()->all(), 'id', 'rubric_title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'rubrics' => $rubrics,
            'authorsList' => $authorsList,
            'data' => $allTags
        ]);
    }



    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException |\Throwable if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Метод изменения поля published ("опубликовано")
     * @param $id
     * @param $decision
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPublish($id, $decision)
    {
        $decision = intval($decision);
        $article = $this->findModel($id);
        $article->publication($decision);

        if ($article->save()) {
            if (1 === $article->publish) {
            Yii::$app->session->setFlash('success', 'Опубликовано');
                return $this->redirect(['index']);
            } elseif (0 === $article->publish){
                Yii::$app->session->setFlash('warning', 'Снято с публикации');
                return $this->redirect([
                    'view',
                    'id' => $article->id
                ]);
            }

        }
    }

    /**
     * Метод убирает изображение из новости
     * @param int $id
     * @throws NotFoundHttpException
     */
    public function actionRemoveArticleImage($id)
    {
        $article = $this->findModel($id);
        $article->deleteArticlesImage();
        return $this->redirect([
            'view',
            'id' => $id
        ]);
    }
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
