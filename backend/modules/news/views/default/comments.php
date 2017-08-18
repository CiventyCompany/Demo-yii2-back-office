<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\community\models\QComments;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\community\models\QCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Commentaries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qcomments-index">

<!--    <p>-->
<!--        --><?php //echo Html::a('Create Qcomments', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'  => "{items}\n{pager}",
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'commentary_id',
            [
                'format' => 'raw',
                'attribute' => 'title',
                'value' => function($model) {
                    if($model->title == '@answer_toQuestion@'){
                        return '-';
                    }
                    return $model->title;
                }
            ],
            'body:ntext',
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function($model){
                    if(!$model->parent_id){
                        return '-';
                    }
                    return QComments::getParentCommentTitle($model->parent_id);
                }
            ],
            [
                'label' => 'Статья',
                'attribute' => 'entity_id',
                'format' => 'raw',
                'value' => function($model){
                    $title = \backend\modules\news\models\News::getParentCommentTitle($model->entity_id);
                    return $title;
                }
            ],
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($model){
                    $userName = \backend\modules\user\models\Profile::getUserFullName($model->user_id);
                    return "<a data-pjax=\"0\" href='/user/registered/view?id=".$model->user_id."'>".$userName."</a>";
                }
            ],
            [
                'format' => 'raw',
                'filter' => false,
                'attribute' => 'likes'
            ],
            [
                'format' => 'raw',
                'filter' => false,
                'attribute' => 'dislikes'
            ],
           //'parent_id',
            [
                'attribute' => 'm_status',
                'format' => 'raw',
                'value' => function($model){
                    $confirm = '';
                    if($model->m_status == QComments::STATUS_MODERATION){
                        $confirm = '<div class="label label-info">' . Yii::t('app', 'On moderation') . '</div>';
                    }elseif($model->m_status == QComments::STATUS_POSTED){
                        $confirm = '<div class="label label-success">' . Yii::t('app', 'Posted') . '</div>';
                    }elseif($model->m_status == QComments::STATUS_HIDDEN){
                        $confirm = '<div class="label label-warning">' . Yii::t('app', 'Hidden') . '</div>';
                    }elseif($model->m_status == QComments::STATUS_BLOCKED){
                        $confirm = '<div class="label label-danger">' . Yii::t('app', 'Blocked') . '</div>';
                    }

                    return $confirm;
                },
                'filter' => Html::activeDropDownList($searchModel, 'm_status', QComments::getStatusDropDown(),
                    ['prompt' => '', 'class' => 'form-control'])
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
                'format' => 'raw',
                'value' => function($model){
                    $updateBtn = '<a href="/community/q-comments/update?id='.$model->commentary_id.'"><span class="glyphicon glyphicon-pencil"></span></a>';
                    $deleteBtn = '<a href="/news/default/delete-comment?id='.$model->commentary_id.'"><span class="glyphicon glyphicon-trash"></span></a>';
                    return $updateBtn.PHP_EOL.$deleteBtn;
                }
            ],
        ],
    ]); ?>
</div>
