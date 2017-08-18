<?php
namespace backend\behaviors;

use Yii;
use common\helpers\UploadForm;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

class UploadFileBehavior extends Behavior
{
    public $field = 'image';
    public $fromField = 'image';
    public $prefix = '';

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
        ];
    }

    public function beforeSave()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($this->owner, $this->fromField);
            $filename = $this->prefix . time();
            if( $fileUrl = $model->upload( $filename ) ){
                $this->owner->{$this->field} = $fileUrl;
            }
        }
    }
}