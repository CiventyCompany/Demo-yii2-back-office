<?php
namespace backend\helpers;

use mihaildev\elfinder\ElFinder;
use Yii;
use common\modules\app_interface\models\SiteSettings;
use yii\widgets\ActiveForm;

/**
 * Class TypeInputHelper
 * @package backend\helpers
 */

class TypeInputHelper
{

    /**
     * @param $form ActiveForm
     * @param $model SiteSettings
     * @param $attribute
     * @param null $type
     * @return mixed
     *
     */
    public static function getTypeInput($form , $model, $attribute, $type = null)
   {
       switch ($type){

           case SiteSettings::TYPE_STRING:
               return $form->field($model, $attribute)->textInput(['maxlength' => true]);
           break;

           case SiteSettings::TYPE_IMAGE:
               return $form->field($model, $attribute)->widget(ElFinder::className());
           break;

           case SiteSettings::TYPE_DOCUMENT:

           break;

           case null:
               return $form->field($model, $attribute)->textInput(['maxlength' => true]);
           break;
       }
   }
}