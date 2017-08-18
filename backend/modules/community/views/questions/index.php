<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\community\models\Questions;
use common\modules\community\models\QuestionsCategories;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\community\models\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'  => "{items}\n{pager}",
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'question_id',
            'title',
            [
                'format' => 'raw',
                'attribute' => 'category_id',
                'value' => function($model){
                    return \common\modules\community\models\QuestionsCategories::getCategoryTitle($model->category_id);
                },
                'filter' => Html::activeDropDownList($searchModel, 'category_id', QuestionsCategories::getCategoriesDropDown(),
                    ['prompt' => '', 'class' => 'form-control'])
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
            [
                'format' => 'raw',
                'filter' => false,
                'attribute' => 'views'
            ],
            [
                'attribute' => 'm_status',
                'format' => 'raw',
                'value' => function($model){
                    $confirm = '';
                    if($model->m_status == Questions::STATUS_MODERATION){
                        $confirm = '<div class="label label-warning">' . Yii::t('app', 'On moderation') . '</div>';
                    }elseif($model->m_status == Questions::STATUS_POSTED){
                        $confirm = '<div class="label label-success">' . Yii::t('app', 'Posted') . '</div>';
                    }elseif($model->m_status == Questions::STATUS_HIDDEN){
                        $confirm = '<div class="label label-danger">' . Yii::t('app', 'Hidden') . '</div>';
                    }elseif($model->m_status == Questions::STATUS_BLOCKED){
                        $confirm = '<div class="label label-danger">' . Yii::t('app', 'Blocked') . '</div>';
                    }
                    return $confirm;
                },
                'filter' => Html::activeDropDownList($searchModel, 'm_status', Questions::getStatusDropDown(),
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
                    $alias = $model->alias;
                    return '<a target="_blank" href="'. Yii::$app->params['frontURL'] .'/question/'.$alias.'"><span class="glyphicon glyphicon-eye-open"></span></a>';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
