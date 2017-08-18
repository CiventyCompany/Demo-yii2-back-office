<?php

namespace backend\modules\export;
use backend\helpers\traits\AccessTrait;

/**
 * identification module definition class
 */

class Module extends \yii\base\Module
{
    use AccessTrait;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\export\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
