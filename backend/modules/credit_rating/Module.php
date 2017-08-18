<?php

namespace backend\modules\credit_rating;
use backend\helpers\traits\AccessTrait;
use common\modules\event\behaviors\ModuleEventsBehavior;
use yii\helpers\ArrayHelper;

/**
 * identification module definition class
 */

class Module extends \common\modules\credit_rating\Module
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

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\credit_rating\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
