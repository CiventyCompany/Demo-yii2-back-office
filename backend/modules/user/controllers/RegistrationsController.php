<?php
namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\UserRegisterLog;
use backend\modules\user\models\UserRegisterLogSearch;

class RegistrationsController extends AdminController
{
    public function actionIndex()
    {
        $searchModel = new UserRegisterLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionView($id)
    {
        $model = UserRegisterLog::find()->where(['session_id' => $id])->one();

        if($model) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect('index');
        }
    }

    public function actionDelete($id, $ip=null)
    {
        $model = UserRegisterLog::find()->where(['session_id' => $id])->one();

        if($model){
            $model->delete();
        }

        return $this->redirect('index');
    }

}
