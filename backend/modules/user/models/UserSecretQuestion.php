<?php
namespace backend\modules\user\models;

use Yii;

class UserSecretQuestion extends \common\modules\user\models\UserSecretQuestion
{
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Answer'),
            'name' => Yii::t('app', 'Question'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }
}