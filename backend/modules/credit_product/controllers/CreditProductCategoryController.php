<?php

namespace backend\modules\credit_product\controllers;

use common\helpers\TreeHelper;
use common\modules\credit_product\models\CreditProductCategoryGroup;
use Yii;
use common\modules\credit_product\models\CreditProductCategory;
use backend\modules\credit_product\models\search\CreditProductCategorySearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CreditProductCategoryController implements the CRUD actions for CreditProductCategory model.
 */
class CreditProductCategoryController extends Controller
{
    /**
     * Lists all CreditProductCategory models.
     * @return mixed
     */
    public function actionIndex( $typeId = 1 )
    {
        $searchModel = new CreditProductCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $typeId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'types' => $searchModel->getTypes(),
            'typeId' => $typeId,
        ]);
    }

    /**
     * Displays a single CreditProductCategory model.
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
     * Creates a new CreditProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreditProductCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CreditProductCategory model.
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
     * Deletes an existing CreditProductCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetByType()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $results = [
            'status' => 'ok',
            'html' => Html::dropDownList('CreditProduct[credit_product_category_ids]', 0, [], ['class' => 'form-control', 'multiple'=>'multiple'] )
        ];
        $type_id = Yii::$app->request->get('type_id');
        if($type_id){
            $groups = CreditProductCategoryGroup::find()->select(['id'])->where(['credit_product_type_id' => Yii::$app->request->get('type_id')])->asArray()->all();
            if($groups){
                $groupIds = [];
                foreach ($groups as $group){
                    $groupIds[] = $group['id'];
                }
                $items = TreeHelper::getTreeListData( CreditProductCategory::className(), 0, ['id', 'title'], ['sort' => SORT_ASC], ['in', 'credit_product_category_group_id', $groupIds] );
                $results['html'] = Html::dropDownList('CreditProduct[credit_product_category_ids]', 0, $items, ['class' => 'form-control', 'multiple'=>'multiple'] );
            }
        }
        return $results;
    }

    /**
     * Finds the CreditProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CreditProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CreditProductCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
