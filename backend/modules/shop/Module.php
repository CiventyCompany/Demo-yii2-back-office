<?php
namespace backend\modules\shop;

use backend\helpers\traits\AccessTrait;

class Module extends \dektrium\user\Module
{
    use AccessTrait;

    public function init()
    {
        parent::init();
    }
}