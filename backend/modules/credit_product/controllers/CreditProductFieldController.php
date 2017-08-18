<?php

namespace backend\modules\credit_product\controllers;

use dektrium\user\traits\AjaxValidationTrait;
use Yii;
use common\modules\credit_product\models\CreditProductField;
use backend\modules\credit_product\models\search\CreditProductFieldSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CreditProductFieldController implements the CRUD actions for CreditProductField model.
 */
class CreditProductFieldController extends Controller
{
    use AjaxValidationTrait;

    /**
     * Lists all CreditProductField models.
     * @return mixed
     */
    public function actionIndex( $typeId = 1 )
    {
        $searchModel = new CreditProductFieldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $typeId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'types' => $searchModel->getTypes(),
            'typeId' => $typeId,
        ]);
    }

    /**
     * Displays a single CreditProductField model.
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
     * Creates a new CreditProductField model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreditProductField();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CreditProductField model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CreditProductField model.
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
     * Finds the CreditProductField model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CreditProductField the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CreditProductField::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
