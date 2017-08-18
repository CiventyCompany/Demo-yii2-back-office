<?php
namespace backend\modules\social\controllers;

use backend\modules\social\models\SocialShareSearch;
use Yii;

class SocialShareController extends \common\modules\social\controllers\SocialShareController
{
    public function actionIndex()
    {
        $searchModel = new SocialShareSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('SocialShareSearch'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }


}
