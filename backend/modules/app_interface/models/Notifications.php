<?php

namespace backend\modules\app_interface\models;

use Yii;

class Notifications extends \common\modules\app_interface\models\Notifications
{
    /**
     * @return array
     */
    public static function getKeysDropDown()
    {
        return [
            self::KEY_WARNING => Yii::t('app', 'Warning'),
            self::KEY_INFO    => Yii::t('app', 'Info'),
            self::KEY_ERROR   => Yii::t('app', 'Error')
        ];
    }

    /**
     * @return array
     */
    public static function getMarksDropDown()
    {
        return [
            self::MARK_AS_READ   => Yii::t('app', 'Read'),
            self::MARK_AS_UNREAD => Yii::t('app', 'Unread'),
        ];
    }

    public static function getUnreadNotifications()
    {
        $count = Notifications::find()
            ->where(['mark' => Notifications::MARK_AS_UNREAD])
            ->count();

        if($count){
            return $count;
        }

        return null;
    }

    public static function getEntityHref($entity, $entityId, $userId=null)
    {
        $action = '#';
        switch ($entity){
            case 'common\modules\user\models\UserAvatar':
                $action = '/user/registered/view?id='.$userId.'&tab=avatar';
                break;
            case 'common\modules\community\models\QComments':
                $action = '/community/q-comments/update?id='.$entityId;
                break;
            case 'common\modules\community\models\Questions':
                $action = '/community/questions/update?id='.$entityId;
                break;
            case 'common\modules\user\models\UserRecoveryLog':
                $action = '/user/recovery/view?id='.$entityId;
                break;
        }

        return $action;
    }

}
