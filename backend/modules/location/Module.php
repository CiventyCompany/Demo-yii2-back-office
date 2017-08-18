<?php

namespace backend\modules\location;
use backend\helpers\traits\AccessTrait;

/**
 * identification module definition class
 */

class Module extends \common\modules\identification\Module
{
    use AccessTrait;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\location\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
