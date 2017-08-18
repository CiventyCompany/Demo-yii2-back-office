<?php
namespace backend\modules\user\controllers;

use backend\modules\api\models\search\ProMoneyClubLogSearch;
use Yii;

class CreditHistoryController extends AdminController
{
    public function actionIndex()
    {
        $model = new ProMoneyClubLogSearch();
        return $this->render('index', ['model' => $model]);
    }
}
