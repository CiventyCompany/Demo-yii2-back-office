<?php
namespace backend\modules\event;

use backend\helpers\traits\AccessTrait;

/**
 * identification module definition class
 */

class Module extends \common\modules\event\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\event\controllers';

    use AccessTrait;
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
