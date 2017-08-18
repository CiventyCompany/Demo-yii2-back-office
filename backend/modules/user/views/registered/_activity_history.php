<?php
use yii\widgets\Pjax;
use yii\grid\GridView;

/**
 * @var \backend\modules\user\models\User $model
 * @var $UserAccessLogSearchDataProvider
 * @var $UserAccessLogSearch
*/
?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $UserAccessLogSearchDataProvider,
    'filterModel'  	=> $UserAccessLogSearch,
    'layout'  => "{items}\n{pager}",
    'columns' => [
        'id',
        'browser',
        [
            'label' => Yii::t('app','Device'),
            'attribute' => 'device',
            'format' => 'raw',
            'value' => function($model){
                return $model->getDevice();
            },
            'filter' => \yii\helpers\Html::activeDropDownList($UserAccessLogSearch, 'device', \backend\modules\user\models\UserAccessLog::getDevices(), ['prompt' => '', 'class' => 'form-control'])
        ],
        [
            'attribute' => 'country',
            'value' => function($model){
                return $model->getCountry().' '.$model->region;
            }
        ],
        'created_at',
        'ip',
    ],
]);
?>
<?= \yii\helpers\Html::button(Yii::t('app', 'End all sessions'), ['id' => 'end-all-sessions', 'class' => 'btn btn-danger', 'data' => ['id' => $model->id]]) ?>

<?php Pjax::end(); ?>