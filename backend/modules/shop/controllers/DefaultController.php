<?php
namespace backend\modules\shop\controllers;

use backend\helpers\traits\AccessTrait;
use backend\modules\shop\models\Product;
use backend\modules\shop\models\ProductSearch;
use Yii;

class DefaultController extends \common\modules\shop\controllers\DefaultController
{
    use AccessTrait;

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('ProductSearch'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Product::find()->where(['id' => $id])->one();

        if(!$model){
            Yii::$app->session->setFlash('error', Yii::t('app', 'Error'));
            return $this->redirect(['/shop/default/index']);
        }

        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
            return $this->redirect(['/shop/default/index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Product();

        if($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['/shop/default/index']);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error'));
            }
        }

        return $this->render('create', ['model' => $model]);
    }
}