<?php

use backend\modules\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use backend\modules\user\helpers\UserDataHelper;

/**
 * @var View $this
 * @var \backend\modules\api\models\search\ProMoneyClubLogSearch $model
 */

$this->title = Yii::t('app', 'Credit Histories');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $model->search( Yii::$app->request->get() ),
    'filterModel'  	=> $model,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'firstname',
        'lastname',
        'midlename',
        [
            'attribute' => 'birthday',
            'filter' => DatePicker::widget([
                'model'      => $model,
                'attribute'  => 'birthday',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        'passport',
        [
            'attribute' => 'passport_date',
            'filter' => DatePicker::widget([
                'model'      => $model,
                'attribute'  => 'passport_date',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'label' => Yii::t('app', 'Credit History'),
            'format' => 'raw',
            'value' => function($model){
                return $model->historyFound() ? '<div class="label label-success">Найдена</div>' : '<div class="label label-danger">Не найдена</div>';
            }
        ]
    ],
]); ?>

<?php Pjax::end() ?>
