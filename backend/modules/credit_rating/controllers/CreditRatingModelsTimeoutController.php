<?php

namespace backend\modules\credit_rating\controllers;

use common\modules\credit_rating\models\CreditRatingHistory;
use Yii;
use common\modules\credit_rating\models\CreditRatingModelsTimeout;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CreditRatingModelsTimeoutController implements the CRUD actions for CreditRatingModelsTimeout model.
 */
class CreditRatingModelsTimeoutController extends Controller
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
     * Lists all CreditRatingModelsTimeout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CreditRatingModelsTimeout::find(),
        ]);
        $models = CreditRatingHistory::getModels();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'models' => $models,
        ]);
    }

    /**
     * Displays a single CreditRatingModelsTimeout model.
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
     * Creates a new CreditRatingModelsTimeout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreditRatingModelsTimeout();
        $models = CreditRatingHistory::getModels();
        $activeModels = CreditRatingModelsTimeout::find()->select('model')->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models' => $models,
                'activeModels' => $activeModels,
            ]);
        }
    }

    /**
     * Updates an existing CreditRatingModelsTimeout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models = CreditRatingHistory::getModels();
        $activeModels = CreditRatingModelsTimeout::find()->select('model')->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'models' => $models,
                'activeModels' => $activeModels,
            ]);
        }
    }

    /**
     * Deletes an existing CreditRatingModelsTimeout model.
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
     * Finds the CreditRatingModelsTimeout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CreditRatingModelsTimeout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CreditRatingModelsTimeout::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
