<?php
namespace backend\modules\user\controllers;

use backend\modules\user\models\search\UserRecoveryLogSearch;
use backend\modules\user\models\UserRecoveryLog;
use Yii;
use yii\web\Response;

class RecoveryController extends AdminController
{
    public function actionIndex()
    {
        $searchModel  = new  UserRecoveryLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    public function actionModeration()
    {
        $searchModel  = new  UserRecoveryLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(), [
            UserRecoveryLogSearch::STATUS_MODERATION,
            UserRecoveryLogSearch::STATUS_MODERATION_IN_PROCESS,
            UserRecoveryLogSearch::STATUS_MODERATION_FAIL,
            UserRecoveryLogSearch::STATUS_MODERATION_COMPLETED
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    public function actionCompleted()
    {
        $searchModel  = new  UserRecoveryLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(), [
            UserRecoveryLogSearch::STATUS_MODERATION_COMPLETED,
            UserRecoveryLogSearch::STATUS_COMPLETED,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    public function actionView( $id )
    {
        $model  = UserRecoveryLog::findOne( $id );
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionSetStatus( $id, $status )
    {
        $model  = UserRecoveryLog::findOne( $id );
        $model->updateAttributes(['status' => $status]);
        return $this->redirect( $_SERVER['HTTP_REFERER'] );
    }
}
