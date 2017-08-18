<?php

namespace backend\modules\user\models;

use Yii;

class UserInvitationEmail extends \frontend\modules\user\models\UserInvitationEmail
{
    const COMPLETED = 1;
    const NOT_COMPLETED = 0;
    public $is_completedArray;

    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'Who invite'),
            'firstname' => Yii::t('app', 'Fist name who invited'),
            'firstname_user' => Yii::t('app', 'Fist name who invite'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status')
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id'])->viaTable('user', ['id' => 'user_id']);
    }

    public function is_completed()
    {
        return $this->status == self::STATUS_REGISTERED ? Yii::t('app', 'Completed') : Yii::t('app', 'Not completed');
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_NOT_INTERESTED => Yii::t('app', 'Not interested'),
            self::STATUS_SENT => Yii::t('app', 'Sent'),
            self::STATUS_DELIVERED => Yii::t('app', 'Delivered'),
            self::STATUS_READ => Yii::t('app', 'Read'),
            self::STATUS_REGISTERED => Yii::t('app', 'Registered'),
        ];
    }
}