<?php
namespace backend\modules\social\controllers;

use backend\modules\social\models\SocialShareSettingsSearch;
use Yii;
use yii\web\Controller;

class SocialShareSettingsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new SocialShareSettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('SocialShareSettingsSearch'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

}
