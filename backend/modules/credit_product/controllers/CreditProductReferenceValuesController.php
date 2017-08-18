<?php

namespace backend\modules\credit_product\controllers;

use Yii;
use common\modules\credit_product\models\CreditProductReferenceValues;
use backend\modules\credit_product\models\search\CreditProductReferenceValuesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CreditProductReferenceValuesController implements the CRUD actions for CreditProductReferenceValues model.
 */
class CreditProductReferenceValuesController extends Controller
{
    /**
     * Lists all CreditProductReferenceValues models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CreditProductReferenceValuesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CreditProductReferenceValues model.
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
     * Creates a new CreditProductReferenceValues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreditProductReferenceValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/credit_product/credit-product-reference/update', 'id' => $model->credit_product_reference_id, 'sort' => 'sort', 'tab' => 'values']);
        } else {
            if( isset($_GET['credit_product_reference_id']) ){
                $model->credit_product_reference_id = $_GET['credit_product_reference_id'];
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CreditProductReferenceValues model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/credit_product/credit-product-reference/update', 'id' => $model->credit_product_reference_id, 'sort' => 'sort', 'tab' => 'values']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CreditProductReferenceValues model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/credit_product/credit-product-reference/update', 'id' => $model->credit_product_reference_id, 'sort' => 'sort', 'tab' => 'values']);
    }

    /**
     * Finds the CreditProductReferenceValues model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CreditProductReferenceValues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CreditProductReferenceValues::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
