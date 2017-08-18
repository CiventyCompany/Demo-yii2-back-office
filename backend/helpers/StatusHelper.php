<?php
namespace backend\helpers;

use Yii;

class StatusHelper
{
    const STATUS_DELETED = -1;
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    public static function getStatusList($type)
    {
        if($type == true){
            return [
                self::STATUS_DELETED => '<div class="label label-danger">'.Yii::t('app', 'Status Deleted').'</div>',
                self::STATUS_DRAFT =>  '<div class="label label-warning">'.Yii::t('app', 'Status Draft').'</div>',
                self::STATUS_PUBLISHED => '<div class="label label-success">'. Yii::t('app', 'Status Published').'</div>'
            ];
        }
        return [
            self::STATUS_DELETED => Yii::t('app', 'Status Deleted'),
            self::STATUS_DRAFT =>  Yii::t('app', 'Status Draft'),
            self::STATUS_PUBLISHED =>  Yii::t('app', 'Status Published')
        ];
    }
}