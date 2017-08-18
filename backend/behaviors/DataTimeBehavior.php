<?php
namespace backend\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class DataTimeBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    public function beforeInsert($event)
    {
        $this->prepareDate(true);
    }

    public function beforeUpdate($event)
    {
        $this->prepareDate();
    }

    private function prepareDate($insert = false)
    {
        if($this->owner->created_at){
            $this->owner->created_at = strtotime($this->owner->created_at);
        }

        if($this->owner->updated_at){
            $this->owner->updated_at = strtotime($this->owner->updated_at);
        }

        if($insert && !$this->owner->created_at){
            $this->owner->created_at = time();
        }

        if(!$this->owner->updated_at){
            $this->owner->updated_at = time();
        }
    }

}