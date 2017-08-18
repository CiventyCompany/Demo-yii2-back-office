<?php
use yii\widgets\Pjax;
use yii\grid\GridView;

/**
 * @var \backend\modules\user\models\User $model
*/
?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $UserAccessLogSearchDataProvider,
    'filterModel'  	=> $UserAccessLogSearch,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'id',
        'browser',
        'created_at',
        [
            'attribute' => 'country',
            'value' => function($model){
                return $model->getCountry();
            }
        ],
        'ip',
    ],
]);
?>

<?php Pjax::end(); ?>