<?php
namespace backend\modules\app_interface;

use backend\helpers\traits\AccessTrait;
use common\modules\app_interface\Module as CommonModule;

class Module extends CommonModule
{
    use AccessTrait;
}