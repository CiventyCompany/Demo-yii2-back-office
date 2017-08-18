<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use yii\helpers\Html;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var \backend\modules\user\models\search\UserRecoveryLogSearch $searchModel
 */

?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'id',
        [
            'label' => Yii::t('app', 'User'),
            'filter' => Html::activeTextInput($searchModel, 'user', ['class' => 'form-control']),
            'format' => 'raw',
            'value' => function($model){
                $user = $model->getUser();
                if( $user instanceof \common\modules\user\models\User ){
                    return \yii\helpers\Html::a( $user->profile->getFullName(), ['/user/registered/view', 'id' => $user->id] );
                } else {
                    return '-';
                }
            }
        ],
        [
            'label' => Yii::t('app', 'Type'),
            'filter' => Html::activeDropDownList($searchModel, 'type', [
                'PASSWORD' => 'Восстановление пароля',
                'RECOVERY' => 'Восстановление аккаунта'
            ], ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
            'value' => function($model){
                return $model->getDataLabel( $model->data['type'] );
            }
        ],
        [
            'label' => Yii::t('app', 'Passport'),
            'filter' => Html::activeTextInput($searchModel, 'username', ['class' => 'form-control']),
            'value' => function($model){
                return isset($model->data['username']) ? $model->data['username'] : '-';
            }
        ],
        [
            'label' => Yii::t('app', 'SNILS'),
            'filter' => Html::activeTextInput($searchModel, 'snils', ['class' => 'form-control']),
            'value' => function($model){
                return isset($model->data['snils']) ? $model->data['snils'] : '-';
            }
        ],
        /*
        [
            'attribute' => 'session_id',
        ],
        [
            'attribute' => 'ip',
        ],
        [
            'attribute' => 'browser',
        ],
        */
        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'status', $searchModel->getStatusText( Yii::$app->controller->action->id ), ['prompt' => Yii::t('app', 'All'), 'class' => 'form-control']),
            'value' => function($model){
                return $model->getStatusLabel();
            }
        ],
        [
            'attribute' => 'created_at',
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'created_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'attribute' => 'updated_at',
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'updated_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template'=>'{view}',
        ]
    ],
]); ?>

<?php Pjax::end() ?>
