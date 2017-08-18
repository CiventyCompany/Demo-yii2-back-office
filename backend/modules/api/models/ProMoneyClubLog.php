<?php
namespace backend\modules\api\models;

use Yii;

class ProMoneyClubLog extends \common\modules\api\models\ProMoneyClubLog
{
    public function historyFound()
    {
        return ($this->data->ERROR || $this->data->RESULT_DATA->have_ch == false) ? false : true;
    }
}
