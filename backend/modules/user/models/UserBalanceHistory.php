<?php

namespace backend\modules\user\models;

use Yii;

class UserBalanceHistory extends \common\modules\user\models\UserBalanceHistory
{
    public function attributeLabels()
    {
        return [
            'changeBalance' => Yii::t('app', 'Change balance'),
            'balanceType' => Yii::t('app', 'Balance type'),
            'created_at' => Yii::t('app', 'Created At'),
            'ip' => Yii::t('app', 'Ip'),
            'change_balance_external' => Yii::t('app', 'Change Balance External'),
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getType($value)
    {
        return self::getTypesBack()[$value];
    }

    public function getTitle()
    {
        if($this->type == self::TYPE_ADMIN){
            return Yii::t('app','Admin');
        }

        $res = $this->getEntity()->one();
        return isset($res) && count($res) > 0 ? $res->title : null;
    }

    public static function getTypesBack()
    {
        return [
            self::TYPE_EXPENSE => Yii::t('app', 'Consumption'),
            self::TYPE_INCOME_LOCAL => Yii::t('app', 'Bonusirovanie'),
            self::TYPE_INCOME_EXTERNAL => Yii::t('app', 'Refill'),
            self::TYPE_ADMIN => Yii::t('app', 'By admin')
        ];
    }

    public function getTypes()
    {
        return [
            self::TYPE_EXPENSE => Yii::t('app', 'Consumption'),
            self::TYPE_INCOME_LOCAL => Yii::t('app', 'Bonusirovanie'),
            self::TYPE_INCOME_EXTERNAL => Yii::t('app', 'Refill'),
            self::TYPE_ADMIN => Yii::t('app', 'By admin')
        ];
    }
}