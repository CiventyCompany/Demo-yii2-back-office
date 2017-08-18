<?php
namespace backend\behaviors;

use Yii;
use common\helpers\ClassHelper;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class TranslateBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'afterDelete',
        ];
    }

    public function afterDelete($event)
    {
        $model = ClassHelper::getClassName($this->owner);

        $deleteVarcharTranslates = "DELETE FROM translate_varchar WHERE model = '{$model}' AND id = {$this->owner->id}";
        $deleteTextTranslates = "DELETE FROM translate_text WHERE model = '{$model}' AND id = {$this->owner->id}";

        Yii::$app->db->createCommand($deleteVarcharTranslates)->execute();
        Yii::$app->db->createCommand($deleteTextTranslates)->execute();
    }

}