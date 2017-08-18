<?php

namespace backend\modules\app_interface\controllers;

use common\modules\app_interface\models\SeoData;
use Yii;
use common\modules\app_interface\models\Seo;
use backend\modules\app_interface\models\SeoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeoController implements the CRUD actions for Seo model.
 */
class SeoController extends Controller
{
    /**
     * Lists all Seo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $seo = Seo::findOne($id);
        if (!$seo) {
            throw new NotFoundHttpException("Seo model was not found.");
        }

        $seoData = SeoData::findOne(['seo_id' => $id]);
//        if (!$seoData) {
//            throw new NotFoundHttpException("Seo model has no data.");
//        }


        if ($seo->load(Yii::$app->request->post()) && $seoData->load(Yii::$app->request->post())) {
            $isValid = $seo->validate();
            $isValid = $seoData->validate() && $isValid;
            if ($isValid) {
                $seo->save();
                $seoData->save();
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'seo'     => $seo,
            'seoData' => $seoData,
        ]);
    }

    /**
     * Deletes an existing Seo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
