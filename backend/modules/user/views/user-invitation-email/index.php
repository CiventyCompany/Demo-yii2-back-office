<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use backend\modules\user\helpers\UserDataHelper;
use yii\jui\DatePicker;
use backend\modules\user\models\UserInvitationEmail;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var \backend\modules\user\models\UserInvitationEmailSearch $searchModel
 */

$this->title = Yii::t('app', 'All invites');
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
        'user_id',
        [
            'attribute' => 'firstname_user',
            'format' => 'raw',
            'value' => function($model){
                return isset($model->user) ? "<a data-pjax=\"0\" href='/user/registered/view?id=".$model->user_id."'>".$model->user->getFullName()."</a>" : null;
            }
        ],
        'firstname',
        'email',
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
            'attribute' => 'status',
            'value' => function($model){
                $statuses = UserInvitationEmail::getStatusArray();
                return $statuses[ $model->status ];
            },
            'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'status', UserInvitationEmail::getStatusArray(), [
                'prompt' => '', 'class' => 'form-control'])
        ],
    ],
]); ?>

<?php Pjax::end() ?>
