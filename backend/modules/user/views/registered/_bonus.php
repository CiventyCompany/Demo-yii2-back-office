<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $repostsSearchModel \backend\modules\social\models\SocialShareSearch */
/* @var $repostsDataProvider \backend\modules\social\models\SocialShare */
?>

<?php Pjax::begin(['id' => 'balancePjax']); ?>

<?= GridView::widget([
    'dataProvider' 	=> $balanceDataProvider,
    'filterModel'  	=> $balanceSearchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'fullBalance',
            'label' => Yii::t('app', 'Full balance'),
            'value' => function($model){
                return $model->local + $model->external;
            }
        ],
       'local',
       'external'
    ],
]);

?>

<?php Pjax::end(); ?>

<button type="button" class="btn btn-success" data-status="false" data-userId="<?= Yii::$app->request->get('id'); ?>" data-toggle="modal" data-target="#balanceModal">
    <?= Yii::t('app', 'Update balance'); ?>
</button>

