<?php

namespace backend\modules\user\controllers;

use backend\modules\user\models\UserActionPrice;
use Yii;
use backend\modules\user\models\UserActionPriceSearch;
use yii\web\Controller;

class BonusController extends Controller
{
    public function actionIndex()
    {
        $modelSearch = new UserActionPriceSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->get('UserActionPriceSearch'));

        return $this->render('index', ['searchModel' => $modelSearch, 'dataProvider' => $dataProvider]);
    }

    public function actionUpdate($id)
    {
        $model = UserActionPrice::find()->where(['id' => $id])->one();

        if(isset($model)){
            if($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect('index');
            }

            return $this->render('update', ['model' => $model]);
        }

        Yii::$app->session->setFlash('error', Yii::t('app', 'Record not found'));
        return $this->redirect('index');
    }

}