<?php
namespace backend\modules\user\controllers;

use Yii;

class AdminController extends \common\modules\user\controllers\AdminController
{
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ],
        ];
    }
}
