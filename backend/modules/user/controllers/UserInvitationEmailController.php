<?php

namespace backend\modules\user\controllers;

use backend\modules\user\models\UserInvitationEmailSearch;
use yii\web\Controller;
use Yii;

class UserInvitationEmailController extends Controller
{
    public function actionIndex()
    {
        $searchModel  = new UserInvitationEmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('UserInvitationEmailSearch'));

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

}