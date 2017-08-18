<?php

namespace backend\modules\services\models;

use backend\behaviors\UploadFileBehavior;
use Yii;

class PostService extends \common\modules\services\models\PostService
{
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['link'] =  Yii::t('app', 'Post Link');
        $labels['name'] =  Yii::t('app', 'Service Name');
        return $labels;
    }
}
