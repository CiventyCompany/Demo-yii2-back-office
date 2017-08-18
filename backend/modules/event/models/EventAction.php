<?php
namespace backend\modules\event\models;

class EventAction extends \common\modules\event\models\EventAction
{
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }

}