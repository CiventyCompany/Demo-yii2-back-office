<?php
namespace backend\modules\user\controllers;

use backend\modules\user\models\UserTransactionsSearch;
use yii\web\Controller;
use Yii;

class TransactionsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new UserTransactionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('UserTransactionsSearch'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

}