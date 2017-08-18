<?php

use backend\modules\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use \yii\helpers\Html;
use \backend\modules\user\models\UserTransactions;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 * @var \backend\modules\user\models\UserTransactions $model
 */

$this->title = Yii::t('app', 'Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('user'),
]) ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'id',
        [
            'attribute' => 'fullName',
            'format' => 'raw',
            'label' => Yii::t('app', 'Full name'),
            'value' => function($model){
                return isset($model->profile)  && count($model->profile) > 0 ? "<a data-pjax=\"0\" href='/user/registered/view?id=".$model->user_id."'>".$model->profile->getFullName()."</a>" : null;
            }
        ],
        'title',
        'description',
        'price',
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function($model){
                return UserTransactions::getStatus($model->status);
            },
            'filter' => Html::activeDropDownList($searchModel, 'status', UserTransactions::getStatus(), [
                'class' => 'form-control',
                'prompt' => Yii::t('app', 'Select')
            ])
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
        ]
    ],
]); ?>

<?php Pjax::end() ?>
