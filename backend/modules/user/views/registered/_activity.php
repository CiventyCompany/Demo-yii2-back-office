<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use \backend\modules\user\models\UserAccessLog;

/* @var $activitySearchModel \backend\modules\user\models\UserAccessLogSearch */
/* @var $activityDataProvider \yii\data\ActiveDataProvider */
/* @var $model \backend\modules\user\models\UserAccessLog */
?>

<?= $this->render('../user-activities/index', [
    'searchModel' => $activitySearchModel,
    'dataProvider' => $activityDataProvider
]);
?>



<!--GridView::widget([-->
<!--    'dataProvider' 	=> $activityDataProvider,-->
<!--    'filterModel'  	=> $activitySearchModel,-->
<!--    'options' => ['style' => 'overflow: auto;'],-->
<!--    'layout'  		=> "{items}\n{pager}",-->
<!--    'columns' => [-->
<!--        'id',-->
<!--        'device',-->
<!--        [-->
<!--            'attribute' => 'is_mobile_app',-->
<!--            'value' => function($model){-->
<!--                return $model->isMobile();-->
<!--            },-->
<!--            'filter' => \yii\helpers\Html::activeDropDownList($activitySearchModel, 'is_mobile_app', UserAccessLog::getLabels(),-->
<!--                [-->
<!--                    'prompt' => Yii::t('app', 'Select'),-->
<!--                    'class' => 'form-control'-->
<!--                ]-->
<!--            )-->
<!--        ],-->
<!--        'browser',-->
<!--        'country',-->
<!--        'user_agent',-->
<!--        'ip',-->
<!--        [-->
<!--            'attribute' => 'created_at',-->
<!--            'format' => ['date', 'php:Y-m-d'],-->
<!--            'filter' => DatePicker::widget([-->
<!--                'model'      => $activitySearchModel,-->
<!--                'attribute'  => 'created_at',-->
<!--                'dateFormat' => 'php:Y-m-d',-->
<!--                'options' => [-->
<!--                    'class' => 'form-control',-->
<!--                ],-->
<!--            ]),-->
<!--        ],-->
<!--    ],-->
<!--]);-->
