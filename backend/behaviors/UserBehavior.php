<?php
namespace backend\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class UserBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    public function beforeInsert($event)
    {
        $this->owner->user_id = Yii::$app->user->getId();
    }

}