<?php
namespace backend\modules\user\models;

use Yii;

class UserPhones extends \common\modules\user\models\UserPhones
{
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', 'Phone')
        ];
    }

}
