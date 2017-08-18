<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\user\helpers\UserDataHelper;
use yii\jui\DatePicker;

$this->title = Yii::t('app', 'All sharing');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'user_id',
        [
            'attribute' => 'fullName',
            'format' => 'raw',
            'value' => function($model){
                return isset($model->profile)  && count($model->profile) > 0 ? "<a data-pjax=\"0\" href='/user/registered/view?id=".$model->user_id."'>".$model->profile->getFullName()."</a>" : null;
            }
        ],
        [
            'attribute' => 'social_name',
            'value' => 'settings.social_name'
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
        'post_id'
    ],
]); ?>

<?php Pjax::end() ?>
