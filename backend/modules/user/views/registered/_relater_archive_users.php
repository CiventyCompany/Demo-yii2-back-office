<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use \backend\modules\user\models\UserAccessLog;

/**
 * @var \yii\data\ActiveDataProvider $searchModel
 * @var \backend\modules\user\models\UserSearch $model
 */
?>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $searchModel,
    'filterModel'  	=> $model,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'id',
        ],
        [
            'attribute' => 'fullName',
            'format' => 'raw',
            'value' => function($model){
                return isset($model->profile) ? $model->profile->getFullName() : null;
            }
        ],
        [
            'attribute' => 'email',
            'format' => 'raw',
            'value' => function($model){
                if($model->email_confirm){
                    $confirm = '<div class="label label-success">' . Yii::t('app', 'Confirmed') . '</div>';
                }else{
                    $confirm = '<div class="label label-danger">' . Yii::t('app', 'Not confirmed') . '</div>';
                }

                return $confirm . "<div>{$model->email}</div>";
            }
        ],
        [
            'attribute' => 'phones',
            'format' => 'raw',
            'value' => function($model){
                if($model->phone_confirm){
                    $confirm = '<div class="label label-success">' . Yii::t('app', 'Confirmed') . '</div>';
                }else{
                    $confirm = '<div class="label label-danger">' . Yii::t('app', 'Not confirmed') . '</div>';
                }

                $phone = $model->getPhone();
                return $confirm . "<div>{$phone}</div>";
            }
        ],
        [
            'attribute' => 'passport',
            'value' => function($model){
                return is_object($model->profile) ? $model->profile->concatPassport() : '';
            }
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:d-m-Y'],
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
            'attribute' => 'last_activity_at',
            'format' => ['date', 'php:d-m-Y'],
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'last_activity_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        //'last_activity_ip',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'buttons'=>[
                'view' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['user/archive/view', 'id' => $model->id]);
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                },

            ],
            'template'=>'{view}',
        ]
    ],
]);
?>

<?php Pjax::end(); ?>