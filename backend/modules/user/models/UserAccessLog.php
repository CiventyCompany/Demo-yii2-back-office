<?php

namespace backend\modules\user\models;

use Yii;

class UserAccessLog extends \common\modules\user\models\UserAccessLog
{
    public function attributeLabels()
    {
        return [
            'device' => Yii::t('app', 'Device'),
            'is_mobile_app' => Yii::t('app', 'Is mobile app'),
            'browser' => Yii::t('app', 'Browser'),
            'ip' => Yii::t('app', 'Ip'),
            'country' => Yii::t('app', 'Country'),
            'created_at' => Yii::t('app', 'Created At'),
            'user_agent' => Yii::t('app', 'User agent'),
        ];
    }

    public function isMobile()
    {
        if($this->is_mobile_app == 1){
            return Yii::t('app', 'Yes');
        }else{
            return Yii::t('app', 'No');
        }
    }

    public static function getLabels()
    {
        return [Yii::t('app', 'No'), Yii::t('app', 'Yes')];
    }

    public static function getDevices()
    {
        return parent::getDevices();
    }
}