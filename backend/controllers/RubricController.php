<?php

namespace backend\controllers;

use backend\models\News;
use backend\models\NewsSearch;
use common\models\NewsQuery;
use common\models\Theme;
use Yii;
use common\models\Rubric;
use backend\models\RubricSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class RubricController extends AdminBaseController
{
    /**
     * Lists all Rubric models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RubricSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rubric model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $newsOfRubric = new ActiveDataProvider([
            'query' => News::find()->where(['rubric_id' => $model->id]),
        ]);
        $newsOfRubric->pagination = ['pageSize' => 10];
        return $this->render('view', [
            'model' => $model,
            'newsOfRubric' => $newsOfRubric,
        ]);
    }

    /**
     * Создание рубрики
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rubric();
        $themes = ArrayHelper::map(Theme::find()->all(), 'id','theme_title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'themes' => $themes
        ]);
    }

    /**
     * Обновление данных рубрики
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //Массив тем в формате id=> название. в post-запрос приходит id
        $themes = ArrayHelper::map(Theme::find()->all(), 'id','theme_title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'themes' => $themes
        ]);
    }

    /**
     * Deletes an existing Rubric model.
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
     * Finds the Rubric model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rubric the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubric::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
