<?php

namespace backend\modules\user\controllers;


use backend\modules\user\models\UserBalanceHistory;
use yii\web\Controller;
use backend\modules\user\models\UserBalanceHistorySearch;
use Yii;

class UserActivitiesController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new UserBalanceHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('UserBalanceHistorySearch'));

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionDelete($id)
    {
        $model = UserBalanceHistory::findOne($id);
        if($model){
            $model->delete();
        }
        return $this->redirect('index');
    }
}