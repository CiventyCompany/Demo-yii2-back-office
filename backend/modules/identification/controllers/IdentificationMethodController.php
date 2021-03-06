<?php

namespace backend\modules\identification\controllers;

use backend\modules\identification\models\search\IdentificationHistorySearch;
use common\modules\identification\models\IdentificationHistory;
use common\modules\identification\models\IdentificationMethod;
use common\modules\identification\models\IdentificationMethodCity;
use common\modules\identification\models\search\IdentificationMethodSearch;
use Yii;
use backend\modules\news\models\News;
use yii\base\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IdentificationMethodController implements the CRUD actions for IdentificationMethod model.
 */
class IdentificationMethodController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all IdentificationMethod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IdentificationMethodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IdentificationMethod model.
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
     * Creates a new IdentificationMethod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IdentificationMethod();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IdentificationMethod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IdentificationMethod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateCities()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post =  Yii::$app->request->post();
        IdentificationMethodCity::updateMethodCities( $post['IdentificationMethodCity']['identification_method_id'], isset($post['IdentificationMethodCity']['city_id']) ? $post['IdentificationMethodCity']['city_id'] : [] );
        return [
            'status' => 'ok',
        ];
    }

    /**
     * Deletes an existing IdentificationMethod model.
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
     * Finds the IdentificationMethod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IdentificationMethod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IdentificationMethod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
