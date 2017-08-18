<?php

namespace backend\modules\social\controllers;

use backend\modules\social\models\SocialShareTemplates;
use backend\modules\social\models\SocialShareTemplatesSearch;
use yii\web\Controller;
use Yii;

class SocialShareTemplatesController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new SocialShareTemplatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get('SocialShareTemplatesSearch'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate($id)
    {
         $model = SocialShareTemplates::find()->where(['id' => $id])->one();

        if($model->load(Yii::$app->request->post())){
            if($model->update(false)){
                return $this->redirect('index');
            }
        }

        return $this->render('update', ['model' => $model]);
    }
}