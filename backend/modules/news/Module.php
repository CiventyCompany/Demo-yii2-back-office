<?php

namespace backend\modules\news;
use backend\helpers\traits\AccessTrait;

/**
 * news module definition class
 */
class Module extends \common\modules\news\Module
{
    use AccessTrait;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\news\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
