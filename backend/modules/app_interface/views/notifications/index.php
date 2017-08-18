<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\app_interface\models\Notifications;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\app_interface\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'notification_id',
            [
                'attribute' => 'value',
                'format' => 'raw',
                'value' => function($model){
                    $href = Notifications::getEntityHref($model->entity, $model->entity_id, $model->user_id);
                    if($href !== '#'){
                        $string = "<a target='_blank' href='{$href}'>{$model->value}</a>";
                    }else{
                        $string = "{$model->value}";
                    }
                    return $string;
                }
            ],
            [
                'label' => Yii::t('app','User'),
                'attribute' => 'user_id',
                'format' => 'raw',
                'value'=>function($model){
                    $name = \backend\modules\user\models\Profile::getUserFullName($model->user_id);
                    return "<a href='/user/registered/view?id={$model->user_id}' target='_blank'>{$name}</a>";
                }
            ],
            [
                'label' => Yii::t('app','Type'),
                'attribute' => 'key',
                'format' => 'raw',
                'value' => function($model){
                    $confirm = '';
                    if($model->key == Notifications::KEY_INFO){
                        $confirm = '<div class="label label-info">' . Yii::t('app', 'Info') . '</div>';
                    }elseif($model->key == Notifications::KEY_WARNING){
                        $confirm = '<div class="label label-warning">' . Yii::t('app', 'Warning') . '</div>';
                    }elseif($model->key == Notifications::KEY_ERROR){
                        $confirm = '<div class="label label-danger">' . Yii::t('app', 'Error') . '</div>';
                    }
                    return $confirm;
                },
                'filter' => Html::activeDropDownList($searchModel, 'key', Notifications::getKeysDropDown(),
                    ['prompt' => '', 'class' => 'form-control'])
            ],
            [
                'label' => Yii::t('app','Status'),
                'attribute' => 'mark',
                'format' => 'raw',
                'value' => function($model){
                    $confirm = '';
                    if($model->mark == Notifications::MARK_AS_UNREAD){
                        $confirm = '<div class="label label-warning hoverMark status_label" data-id="'.$model->notification_id.'">' . Yii::t('app', 'Unread') . '</div>';
                    }elseif($model->mark == Notifications::MARK_AS_READ) {
                        $confirm = '<div class="label label-success">' . Yii::t('app', 'Read') . '</div>';
                    }
                    return $confirm;
                },
                'filter' => Html::activeDropDownList($searchModel, 'mark', Notifications::getMarksDropDown(),
                    ['prompt' => '', 'class' => 'form-control'])."<button class=\"btn btn-success\" id='notify_all'>Прочесть все</button>"
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d-m-Y'],
                'filter' => \yii\jui\DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'created_at',
                    'dateFormat' => 'php:d-m-Y',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'  => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
