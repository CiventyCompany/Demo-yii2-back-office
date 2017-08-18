<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\social\models\SocialShareTemplates;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Sharing templates');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    $(document).on('change', '.is_active', function(){
        ajax('is_active', $(this).val(), $(this).parents('tr').find('.id').html());
    });

    $(document).on('change', '.url', function(){
        ajax('url', $(this).val(), $(this).parents('tr').find('.id').html());
    });


    $(document).on('change', '.message', function(){
        ajax('message', $(this).val(), $(this).parents('tr').find('.id').html());
    });


    function ajax(param, value, t_id){
        $.ajax({
            url: '".\yii\helpers\Url::to('/social/social-share-templates/update')."',
            method: 'post',
            data: 't_id=' + t_id + '&' + param + '=' + value,
            success: function(res){
                if(res == 1){
                    $.pjax.reload({container:'#w0'});
                }
            }
        });
    };
");
?>
<div class="debug"></div>
<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'id',
            'format' => 'raw',
            'value' => function($model){
                return '<div class="id">' . $model->id ."</div>";
            }
        ],
        [
            'attribute' => 'social_name',
            'value' => 'settings.social_name',
        ],
        'message',
        'url',
        [
            'attribute' => 'time',
            'format' => 'raw',
            'value' => 'settings.waiting_time'
        ],
        [
            'attribute' => 'is_active',
            'format' => 'raw',
            'value' => function($model){
                return SocialShareTemplates::getStatusArray()[$model->is_active];
            }
        ],
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template'=>'{update}',
        ]
    ],
]); ?>

<?php Pjax::end() ?>
