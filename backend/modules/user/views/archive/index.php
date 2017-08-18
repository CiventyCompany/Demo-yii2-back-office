<?php

use backend\modules\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use backend\modules\user\helpers\UserDataHelper;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 * @var \backend\modules\user\models\Profile $model->profile
 * @var \backend\modules\user\models\UserPhones $model->phone
 * @var \backend\modules\user\models\User $model
 */

$this->title = Yii::t('app', 'Deleted users');
$this->params['breadcrumbs'][] = $this->title;

if($params = Yii::$app->request->get('UserSearch')){
    if(isset($params['multiSearch'])){
        $multiSearch = $params['multiSearch'];
    }
}
?>
<form>
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <label><?= Yii::t('app','Multi search'); ?></label>
                <div class="input-group">
                    <input type="text" class="form-control" name="UserSearch[multiSearch]" placeholder="<?= Yii::t('app', 'Enter user data'); ?>" value="<?= isset($multiSearch)? $multiSearch : ''; ?>">
                    <span class="input-group-btn">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-address-book-o" aria-hidden="true"></i>
                        <?= Yii::t('app','Search user'); ?>
                    </button>
                </span>
                </div>
                <p class="text text-info"><?= Yii::t('app', 'Partial search SNILS, passport number, phone or e-mail.'); ?></p>
            </div>
        </div>
    </div>
</form>
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
            'attribute' => 'id',
        ],
        [
            'attribute' => 'fullName',
            'format' => 'raw',
            'value' => function($model){
               return isset($model->profile) ? "<a href='/user/archive/view?id=".$model->id."'>".$model->profile->getFullName()."</a>" : null;
            }
        ],
        [
            'attribute' => 'email',
            'format' => 'raw',
            'value' => function($model){
                if($model->email_confirm){
                    $confirm = '<div class="label label-success">' . Yii::t('app', 'Confirmed') . '</div>';
                }else{
                    $confirm = '<div class="label label-danger">' . Yii::t('app', 'Not confirmed') . '</div>';
                }

                return $confirm . "<div>{$model->email}</div>";
            }
        ],
        [
            'attribute' => 'phones',
            'format' => 'raw',
            'value' => function($model){
                if($model->phone_confirm){
                    $confirm = '<div class="label label-success">' . Yii::t('app', 'Confirmed') . '</div>';
                }else{
                    $confirm = '<div class="label label-danger">' . Yii::t('app', 'Not confirmed') . '</div>';
                }

                $phone = $model->getPhone();
                return $confirm . "<div>{$phone}</div>";
            }
        ],
        [
            'attribute' => 'verified_status',
            'format' => 'raw',
            'value' =>  function($model){
                return $model->getIdentificationText();
            },
            'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'verified_status', $searchModel->getStatuses(), ['prompt' => '', 'class' => 'form-control'])
        ],
//        [
//            'label' => Yii::t('app','Moderation Status'),
//            'format' => 'raw',
//            'value' =>  function($model){
//                $status = \backend\modules\user\models\User::getModerationStatus($model);
//                return \backend\modules\user\models\User::getModerationText($status);
//            }
//        ],
//        [
//            'attribute' => 'passport',
//            'value' => function($model){
//                return is_object($model->profile) ? $model->profile->concatPassport() : '';
//            }
//        ],
        [
            'label' => Yii::t('app','Credit Rating'),
            'format' => 'raw',
            'value' => function($model){
                if(is_object($model->creditRating)){
                    $creditRating = $model->creditRating;;
                    if(is_object($creditRating->lastCreditRatingHistory)){
                        $lastHistory = $creditRating->lastCreditRatingHistory;
                        return $lastHistory->fico_coefficient.' <sup><span class="text-info">'.$lastHistory->dynamics.'</span></sup>';
                    }
                }
                return '-';
            },
            'filter' =>"
<div class=\"input-group\">
      <span class=\"input-group-addon\" id=\"basic-addon1\">".Yii::t('app','From:')."</span>
      ".\yii\helpers\Html::activeTextInput($searchModel,'cr_from',['class' => 'form-control'])."
     
</div>
<div class=\"input-group\">
        <span class=\"input-group-addon\" id=\"basic-addon1\">".Yii::t('app','to:')."</span>
        ".\yii\helpers\Html::activeTextInput($searchModel,'cr_to',['class' => 'form-control'])."
</div>

"
        ],
        [
            'label' => Yii::t('app','Moderation Status'),
            'format' => 'raw',
            'value' =>  function($model){
                $status = \backend\modules\user\models\User::getModerationStatus($model);
                return \backend\modules\user\models\User::getModerationText($status);
            },'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'm_status', $searchModel->getMStatuses(), ['prompt' => '', 'class' => 'form-control'])
        ],
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
            'attribute' => 'last_activity_at',
            'format' => ['date', 'php:d-m-Y'],
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'last_activity_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        //'last_activity_ip',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'buttons'=>[
                'view' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['user/archive/view', 'id' => $model->id]);
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                },

            ],
            'template'=>'{view}',
        ]
    ],
]); ?>

<?php Pjax::end() ?>
