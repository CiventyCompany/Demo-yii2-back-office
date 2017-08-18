<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 25.07.16
 * Time: 18:25
 */

namespace backend\modules\user\models;


class UserBalance extends \common\modules\user\models\UserBalance
{
    public function attributeLabels()
    {
        return [
            'fullBalance' => \Yii::t('app', 'Full balance'),
            'local' => \Yii::t('app', 'Local'),
            'external' => \Yii::t('app', 'External'),
        ];
    }

}