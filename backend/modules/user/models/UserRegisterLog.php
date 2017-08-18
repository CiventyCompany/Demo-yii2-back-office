<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%user_register_log}}".
 *
 * @property string $session_id
 * @property string $ip
 * @property string $created_at
 * @property string $updated_at
 * @property string $data
 * @property integer $user_id
 */
class UserRegisterLog extends \common\modules\user\models\UserRegisterLog
{
    public $smsValidateCode, $checkHistory;

    public function attributeLabels()
    {
        return [
            'checkHistory' => Yii::t('app', 'Check history'),
            'smsValidateCode' => Yii::t('app', 'Sms validate code'),
            'emailValidateCode' => Yii::t('app', 'Email validate code'),
            'midlename' => Yii::t('app', 'Midlename'),
            'lastname' => Yii::t('app', 'Lastname'),
            'firstname' => Yii::t('app', 'Firstname'),
            'birthday' => Yii::t('app', 'Birthday'),
            'passport_number' => Yii::t('app', 'Passport number'),
            'passport_series' => Yii::t('app', 'Passport series'),
            'phone' => Yii::t('app', 'Phone'),
            'phone_confirm' => Yii::t('app', 'Phone confirm'),
            'email' => Yii::t('app', 'Email'),
            'email_confirm' => Yii::t('app', 'Email confirm'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'user_id' => Yii::t('app', 'User ID'),
            'hear' => Yii::t('app', 'Hear'),
            'session_id' => Yii::t('app', 'Session ID'),
            'gender' => Yii::t('app', 'Gender'),
            'checkHistoryLockAt' => Yii::t('app', 'Locked')
        ];
    }

}
