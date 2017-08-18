<?php

namespace backend\helpers;

use Yii;

class SpanHelper
{

    /**
     * @param $status string
     * @return null|string
     */
    public static function getSpanCheckHistory($status)
    {
        switch($status){
            case(null) :
                return '<span class="label label-success">' . Yii::t('app', 'Credit history found') . '</span>';
            case(0) :
                return '<span class="label label-success">' . Yii::t('app', 'Credit history found') . '</span>';
            case(1):
                return '<span class="label label-danger">' . Yii::t('app', 'Credit history not found') . '</span>';
            case(2):
                return '<span class="label label-danger">' . Yii::t('app', 'incorrect credit data') . '</span>';
            default:
                return null;
        }
    }

    /**
     * @param $status string
     * @return null|string
     */
    public static function getSpanConfirm($status)
    {
        switch($status){
            case(0) :
                return '<div class="label label-danger">' . Yii::t('app', 'Not confirmed') . '</div>';
            case(1):
                return '<div class="label label-success">' . Yii::t('app', 'Confirmed') . '</div>';
            default:
                return null;
        }
    }
}