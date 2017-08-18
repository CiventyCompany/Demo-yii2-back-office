<?php
namespace backend\helpers\traits;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


trait AccessTrait
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['error','login','logout'],
                    'allow' => true,
                ],
                [
                    'allow' => true,
                    'roles' => ['admin'],
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                if($action->id !=='login' && $action->id !== 'logout'){
                    \Yii::$app->user->logout();
                    \Yii::$app->session->setFlash('authError',\Yii::t('app','Вы не являетесь администратором на этом ресурсе!'));
                    return \Yii::$app->controller->redirect(['/user/security/login']);
                }
            },
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['POST'],
                'delete' => ['POST']
            ],
        ];

        return $behaviors;
    }
}
