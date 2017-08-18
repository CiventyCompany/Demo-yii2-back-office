<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-backend',
    'language'            => 'ru',
    'sourceLanguage'      => 'en-US',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],

    'modules' => [
        'common' => [
            'class' => \backend\modules\common\Module::className()
        ],
        'user' => [
            'class'                  => \backend\modules\user\Module::className(),
            'enableUnconfirmedLogin' => true,
            'enablePasswordRecovery' => false,
            'enableConfirmation'     => false,
            'enableRegistration'     => false,
            'confirmWithin'          => 21600,
            'cost'                   => 12,
            'admins'                 => ['admin'],

            'controllerMap' => [
                'security' => 'dektrium\user\controllers\SecurityController'
            ],
        ],
        'rbac' => [
            'class' => dektrium\rbac\RbacWebModule::className(),
        ],
        'social' => [
            'class' => \backend\modules\social\Module::className(),
        ],
        'shop' => [
            'class' => backend\modules\shop\Module::className(),
        ],
        'news' => [
            'class' => backend\modules\news\Module::className(),
        ],
        'services' => [
            'class' => \backend\modules\services\Module::className(),
        ],
        'identification' => [
            'class' => \backend\modules\identification\Module::className(),
        ],
        'location' => [
            'class' => \backend\modules\location\Module::className(),
        ],
        'credit_rating' => [
            'class' => \backend\modules\credit_rating\Module::className(),
        ],
        'credit_product' => [
            'class' => \backend\modules\credit_product\Module::className(),
        ],
        'community' => [
            'class' => \backend\modules\community\Module::className(),
        ],
        'app_interface' => [
            'class' => \backend\modules\app_interface\Module::className(),
        ],
        'api' => [
            'class' => \common\modules\api\Module::className()
        ],
        'api_v1' => [
            'class' => \common\modules\api\v1\Module::className()
        ],
        'partners' => [
            'class' => \backend\modules\api\Module::className(),
        ],
        'widgets' => [
            'class' => \common\modules\widgets\Module::className()
        ],
        'user-log' => [
            'class' => \common\modules\user\Module::className()
        ],
        'event' => [
            'class' => \backend\modules\event\Module::className()
        ],
        'export' => [
            'class' => \backend\modules\export\Module::className()
        ],
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                '/'                                             => 'user/registered/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>'    => '<module>/<controller>/<action>',
            ]
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'fileMap'  => [
                        'app' => 'app.php',
                    ],
                ],
                [
                    'system*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@frontend/messages',
                        'fileMap' => [
                            'error' => 'system.php',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class'  => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root'   => [
                'path' => 'uploads',
                'name' => 'uploads'
            ]
        ]
    ],
    'params' => $params,
];
