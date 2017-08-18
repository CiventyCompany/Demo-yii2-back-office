<?php

use backend\modules\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use \yii\helpers\Html;
use \backend\modules\user\models\UserBalanceHistory;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 * @var \backend\modules\user\models\Profile $model->profile
 * @var \backend\modules\user\models\UserBalanceHistory $model
 */

if(\yii\helpers\Url::current() == '/user/user-activities/index'){
    $this->title = Yii::t('app', 'User actions');
}else{
    $this->title = Yii::t('app', 'User').' №'. Yii::$app->request->get('id');
}

$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('user'),
]); ?>

<?php Pjax::begin(['id'=>'actionsPjax']); ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'fullName',
            'label' => Yii::t('app', 'Full name'),
            'format' => 'raw',
            'value' => function($model){
                return isset($model->profile)  && count($model->profile) > 0 ? "<a data-pjax=\"0\" href='/user/registered/view?id=".$model->user_id."'>".$model->profile->getFullName()."</a>" : null;
            }
        ],
        [
            'attribute' => 'changeBalance',
            'format' => 'raw',
            'value' => function($model){
                return $model->change_balance_local;
            }
        ],
        [
            'attribute' => 'change_balance_external',
            'format' => 'raw',
            'value' => function($model){
                return $model->change_balance_external;
            }
        ],
        [
            'attribute' => 'balanceType',
            'format' => 'raw',
            'value' => function($model){
                return $model->getType($model->type);
            },
            'filter' => Html::activeDropDownList($searchModel, 'balanceType', UserBalanceHistory::getTypesBack(), [
                'class' => 'form-control', 'prompt' => Yii::t('app', 'Select')
            ])
        ],
        [
            'attribute' => 'title',
            'label' => Yii::t('app', 'Title'),
            'value' => function($model){
                return $model->getTitle();
            }
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:Y-m-d'],
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'created_at',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        'ip',
        [
            'label' => '',
            'format' => 'raw',
            'value' => function($model){
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/user/user-activities/delete', 'id' => $model->id], [
                    'title' => 'Удалить',
                    'aria-label' => 'Удалить',
                    'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                    'data-method' => 'post',
                    'data-pjax' => 0,
                ]);
            }
        ],
    ],
]); ?>

<?php Pjax::end(); ?>
