<?php
namespace backend\modules\app_interface\widgets;

use yii\base\Widget;
use common\modules\app_interface\models\Notifications;

class HeaderNotifications extends Widget
{
    private $models, $totalCount ;

    public function init()
    {
        $this->totalCount = Notifications::find()
            ->where(['mark' => Notifications::MARK_AS_UNREAD])
            ->count();
        $this->models = Notifications::find()
            ->where(['mark' => Notifications::MARK_AS_UNREAD])
            ->limit(6)
            ->all();

    }

    public function run()
    {
       return $this->render('notifications' ,[
           'models' => $this->models,
           'count' => $this->totalCount
       ]);
    }
}