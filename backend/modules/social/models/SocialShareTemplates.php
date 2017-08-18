<?php

namespace backend\modules\social\models;

use Yii;

class SocialShareTemplates extends \common\modules\social\models\SocialShareTemplates
{
    public $time;
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['safe'] = [['time'], 'safe'];
        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['message'] = \Yii::t('app', 'Messages');
        $labels['social_name'] = \Yii::t('app', 'Social name');
        $labels['time'] = Yii::t('app', 'Sharing time');
        $labels['url'] = Yii::t('app', 'Url');
        return $labels;
    }

    public function getSettings()
    {
        return $this->hasOne(SocialShareSettings::className(), ['social_id' => 'social_id']);
    }

    public static  function getStatusArray()
    {
        return $statusArray = [
            self::STATUS_DISABLE => \Yii::t('app', 'Disable'),
            self::STATUS_ACTIVE => \Yii::t('app', 'Active')
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($this->time && $this->time > 0){
            $this->settings->updateAttributes(['waiting_time' => $this->time]);
        }
    }
}