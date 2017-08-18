<?php
namespace backend\modules\user;

use backend\helpers\traits\AccessTrait;
use backend\modules\user\models\User;
use common\modules\event\behaviors\ModuleEventsBehavior;
use common\modules\event\models\interfaces\ModuleEventsInterface;
use yii\helpers\ArrayHelper;

class Module extends \common\modules\user\Module implements ModuleEventsInterface
{
    use AccessTrait{
        behaviors as traitBehaviors;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(
            parent::behaviors(),
            $this->traitBehaviors(),
            [
                'moduleEventsBehavior' => [
                    'class' => ModuleEventsBehavior::className(),
                ]
            ]
        );
        return $behaviors;
    }

    public static function getEvents()
    {
        return [
            [
                'group' => 'User',
                'label' => 'Email confirmed (admin panel)',
                'model' => User::className(),
                'name' => User::EVENT_EMAIL_CONFIRMED
            ],
            [
                'group' => 'User',
                'label' => 'Phone confirmed (admin panel)',
                'model' => User::className(),
                'name' => User::EVENT_PHONE_CONFIRMED
            ],
        ];
    }
}