<?php
namespace backend\modules\event\models;

use common\helpers\ClassHelper;
use Yii;

class EventHandler extends \common\modules\event\models\EventHandler
{
    public function getTranslateEventsList()
    {
        $list = [];
        foreach ($this->getAllEventsList() as $group => $items){
            foreach($items as $item){
                $value = $item['model'] . ';' . $item['name'];
                $list[ Yii::t('app', $group) ][ $value ] = Yii::t('app', $item['label']);
            }
        }
        return $list;
    }

    public function getTitle( $model, $eventName )
    {
        $modelName = ClassHelper::getClassName( $model );
        foreach ($this->getAllEventsList() as $group => $items){
            foreach($items as $item){
                if($modelName == ClassHelper::getClassName( $item['model'] ) && $eventName == $item['name']){
                    return Yii::t('app', $group) . ': ' . Yii::t('app', $item['label']);
                }
            }
        }
    }

    public function getOnly( $model, $eventName )
    {
        foreach ($this->getAllEventsList() as $group => $items){
            foreach($items as $item){
                if($model == ClassHelper::getClassName($item['model']) && $eventName == $item['name']){
                    return isset($item['only']) ? $item['only'] : [];
                }
            }
        }
    }
}