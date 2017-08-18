<?php
use yii\widgets\DetailView;
use backend\helpers\SpanHelper;
use common\modules\user\models\UserAdminCauses;

/* @var \backend\modules\user\models\Profile $model->profile */
/* @var \backend\modules\user\models\UserPhones $model->phone */
/* @var $model \backend\modules\user\models\User */
/* @var $secretQuestionsModel \backend\modules\user\models\UserSecretQuestion */
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'format' => 'raw',
            'label' => Yii::t('app','Role'),
            'value' => function($model){
                return \backend\modules\user\models\User::getUserRole($model->id);
            }
        ],
        [
            'attribute' => 'profile.avatar',
            'format' => 'raw',
            'value' => ( isset($model->profile->avatar) && $model->profile->avatar instanceof \common\modules\user\models\UserAvatar) ? \yii\bootstrap\Html::img( Yii::$app->params['frontURL'] . $model->profile->avatar->avatar, ['width' => 100] ) : ''
        ],

        'profile.lastname',
        'profile.firstname',
        'profile.midlename',
        [
            'label' => Yii::t('app','Gender'),
            'format' => 'raw',
            'value' => $model->profile->gender == 'M' ? 'Мужской' : 'Женский'
        ],
        'profile.birthday',
        [
            'label' => Yii::t('app','Passport'),
            'format' => 'raw',
            'value' => $model->profile->passport_series . '-' .$model->profile->passport_number
        ],
        'profile.passport_date',
        'profile.snils',
        [
            'attribute' => 'userRegisterLog.checkHistory',
            'format' => 'raw',
            'value' => isset($model->userRegisterLog) ? 
                SpanHelper::getSpanCheckHistory($model->userRegisterLog->getDataParam('checkHistory')) :
                SpanHelper::getSpanCheckHistory(null)
        ],
        [
            'attribute' => 'phones',
            'value' => $model->getPhone()
        ],
        /*
        [
            'attribute' => 'userRegisterLog.smsValidateCode',
            'format' => 'raw',
            'value' => isset($model->userRegisterLog) ? $model->userRegisterLog->getDataParam('smsValidateCode') : null
        ],
        */
        [
            'attribute' => 'phone_confirm',
            'format' => 'raw',
            'value' =>  SpanHelper::getSpanConfirm($model->phone_confirm)
        ],
        'email',
        /*
        [
            'attribute' => 'userRegisterLog.emailValidateCode',
            'format' => 'raw',
            'value' => isset($model->userRegisterLog) ? $model->userRegisterLog->getDataParam('emailValidateCode') : null
        ],
        */
        [
            'attribute' => 'email_confirm',
            'format' => 'raw',
            'value' =>  SpanHelper::getSpanConfirm($model->email_confirm)
        ],
        [
            'attribute' => 'verified_status',
            'format' => 'raw',
            'value' =>  $model->getIdentificationText(),
        ],
        [
            'attribute' => 'hear',
            'value' => $model->getHearMethod()
        ],
        [
            'attribute' => 'last_activity_at',
            'format' => ['date', 'php:d-m-Y'],
            'value' =>  $model->last_activity_at
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:d-m-Y'],
            'value' =>  $model->created_at
        ],
        [
            'attribute' => 'blocked_at',
            'format' => 'raw',
            'value' =>  $model->getBlockedTime()
        ],
        [
            'label'  => Yii::t('app','Reason of block'),
            'format' => 'raw',
            'value'  =>  UserAdminCauses::getCause($model->id, UserAdminCauses::TYPE_BLOCK)
        ],
        [
            'attribute' => 'deleted_at',
            'format' => 'raw',
            'value' =>  $model->getDeletedTime()
        ],
        [
            'label'  => Yii::t('app','Reason of delete'),
            'format' => 'raw',
            'value'  =>  UserAdminCauses::getCause($model->id, UserAdminCauses::TYPE_DELETE_STATUS)
        ],
        [
            'label' => Yii::t('app','Friezed At'),
            'format' => 'raw',
            'value' =>  $model->getFrozenTime()
        ],
        [
            'label'  => Yii::t('app','Reason of freeze'),
            'format' => 'raw',
            'value'  =>  UserAdminCauses::getCause($model->id, UserAdminCauses::TYPE_FREEZE)
        ],
    ]
]);
?>