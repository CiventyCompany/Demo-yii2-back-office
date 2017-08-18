<?php
use yii\widgets\Pjax;
use yii\grid\GridView;

?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $secretQuestionsDataProvider,
    'filterModel'  	=> $secretQuestionsSearchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'value' => function($model){
                return is_object($model->info) ? $model->info->title : '-';
            }
        ],
        'value'
    ],
]);
?>

<?php Pjax::end(); ?>