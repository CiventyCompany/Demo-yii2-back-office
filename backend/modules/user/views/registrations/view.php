<?php

use backend\helpers\SpanHelper;
use yii\widgets\DetailView;
use common\modules\user\models\UserRegisterLog;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserRegisterLog */

$this->title = Yii::t('app','Questionnaire ').'№'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unfinished'), 'url' => ['/user/registrations/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="source-message-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'lastname',
                'format' => 'raw',
                'value' => $model->getDataParam('lastname')
            ],
            [
                'attribute' => 'firstname',
                'format' => 'raw',
                'value' => $model->getDataParam('firstname')
            ],
            [
                'attribute' => 'midlename',
                'format' => 'raw',
                'value' => $model->getDataParam('midlename')
            ],
            [
                'attribute' => 'gender',
                'format' => 'raw',
                'value' => $model->getDataParam('gender')
            ],
            [
                'attribute' => 'birthday',
                'format' => 'raw',
                'value' => $model->getDataParam('birthday')
            ],
            [
                'attribute' => 'passport_number',
                'format' => 'raw',
                'value' => $model->getDataParam('passport_number')
            ],
            [
                'attribute' => 'passport_series',
                'format' => 'raw',
                'value' => $model->getDataParam('passport_series')
            ],
            [
                'label' => Yii::t('app', 'Passport date'),
                'format' => 'raw',
                'value' => $model->getDataParam('passport_date')
            ],
            [
                'label' => Yii::t('app','SNILS'),
                'format' => 'raw',
                'value' => $model->getDataParam('snils')
            ],
            [
                'attribute' => 'checkHistory',
                'format' => 'raw',
                'value' => SpanHelper::getSpanCheckHistory($model->getDataParam('checkHistory'))
            ],
            [
                'attribute' => 'checkHistoryLockAt',
                'format' => 'raw',
                'value' => property_exists($model->data, 'checkHistoryLockAt') ?  '<span class="label label-danger">' . Yii::t('app', 'Yes') .  '</span>' : '<span class="label label-success">' . Yii::t('app', 'No') .  '</span>',
            ],
            [
                'attribute' => 'phone',
                'value' => $model->getDataParam('phone')
            ],
            [
                'attribute' => 'smsValidateCode',
                'format' => 'raw',
                'value' => $model->getDataParam('smsValidateCode')
            ],
            [
                'attribute' => 'phone_confirm',
                'format' => 'raw',
                'value' =>  SpanHelper::getSpanConfirm($model->getDataParam('phone_confirm'))
            ],
            [
                'attribute' => 'email',
                'format' => 'raw',
                'value' => $model->getDataParam('email')
            ],
            [
                'attribute' => 'emailValidateCode',
                'format' => 'raw',
                'value' => $model->getDataParam('emailValidateCode')
            ],
            [
                'attribute' => 'email_confirm',
                'format' => 'raw',
                'value' =>  SpanHelper::getSpanConfirm($model->getDataParam('email_confirm'))
            ],
            [
                'label' => Yii::t('app','Hear'),
                'format' => 'raw',
                'value' => \backend\modules\user\models\User::getHearText($model->getDataParam('hear'))
            ],
            [
                'attribute' => 'created_at',
                'value' => $model->created_at
            ],
            [
                'attribute' => 'updated_at',
                'value' => $model->updated_at
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user_id > 0 ? $model->user_id : '-'
            ],
            [
                'label' => Yii::t('app', 'Browser data'),
                'attribute' => 'browser_data',
                'format' => 'raw',
                'value' => function($model){
                    return \backend\modules\user\helpers\UserDataHelper::getBrowserData($model);
                }
            ],
        ],
    ]) ?>

</div>
