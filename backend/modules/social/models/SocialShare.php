<?php

namespace backend\modules\social\models;

use backend\modules\user\models\Profile;
use Yii;

class SocialShare extends \common\modules\social\models\SocialShare
{
    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'post_id' => Yii::t('app', 'Post id'),
                'social_name' => Yii::t('app', 'Social name'),
                'fullName' =>  Yii::t('app', 'Full name')
            ]
        );
    }

    public function getSettings()
    {
        return $this->hasOne(SocialShareSettings::className(), ['social_id' => 'social_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
}