<?php

namespace backend\modules\social\models;

use Yii;

class SocialShareSettings extends \common\modules\social\models\SocialShareSettings
{
    public function attributeLabels()
    {
        return [
            'social_name' => Yii::t('app', 'Social name'),
            'status' => Yii::t('app', 'Status'),
            'social_id' => Yii::t('app', 'Social id')
        ];
    }

    public function getTemplates()
    {
        return $this->hasOne(SocialShareTemplates::className(), ['social_id' => 'social_id']);
    }
}