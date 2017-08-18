<?php

use dektrium\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use backend\modules\user\helpers\UserDataHelper;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 */

$this->title = Yii::t('app', 'Questionnaires');
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
        [
            'label' => Yii::t('app','Registration ID'),
            'attribute' => 'id'
        ],
        [
            'attribute' => 'username',
            'label' => Yii::t('app', 'Full name'),
            'format' => 'raw',
            'value' => function($model){
                return "<a href='/user/registrations/view?id=".$model->session_id."'>".UserDataHelper::getHtmlFullName($model->data)."</a>";
            },
            'filter' => \yii\helpers\Html::activeTextInput($searchModel, 'username', ['class' => 'form-control']),
        ],
        [
            'label' => Yii::t('app', 'Passport'),
            'format' => 'raw',
            'value' => function($model){
                return UserDataHelper::getPassport($model->data);
            }
        ],
        [
            'label' => Yii::t('app','SNILS'),
            'value' => function($model){
                return \backend\modules\user\models\Profile::getSnils($model->id);
            }
        ],
        [
            'label' => Yii::t('app','Status'),
            'format' => 'raw',
            'attribute' => 'regStatus',
            'value' => function($model){
                if($model->user_id == 0){
                    return '<span class="label label-warning">'.Yii::t('app','In process').'</span>';
                }else{
                    return '<span class="label label-success">'.Yii::t('app','Completed').'</span>';
                }
            },
            'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'regStatus', [
                0 => Yii::t('app','In process'),
                1 => Yii::t('app','Completed')
            ],
                ['prompt' => '', 'class' => 'form-control'])
        ],
//        [
//            'label' => Yii::t('app', 'Browser data'),
//            'format' => 'raw',
//            'value' => function($model){
//                return UserDataHelper::getBrowserData($model);
//            }
//        ],
        [
            'label' => Yii::t('app','Progress'),
            'format' => 'raw',
            'value' => function($model){
               return \backend\modules\user\models\UserRegisterLogSearch::getProgressStatus($model->id);
            },
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:Y-m-d H:i:s'],
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
            'attribute' => 'updated_at',
            'format' => ['date', 'php:Y-m-d H:i:s'],
            'filter' => \yii\jui\DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'updated_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'class' => \yii\grid\ActionColumn::className(),
            'buttons'=>[
                'view'=>function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['user/registrations/view', 'id'=>$model['session_id']]);
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                },
                'delete'=>function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['user/registrations/delete', 'id' => $model['session_id']]);
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                        [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('app', 'Are you sure you want to delete selected items?')
                        ]);
                }
            ],
            'template'=>'{view}   {delete}',
        ]
    ],
]); ?>

<?php Pjax::end() ?>
