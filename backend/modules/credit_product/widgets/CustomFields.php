<?php
namespace backend\modules\credit_product\widgets;

use backend\helpers\StatusHelper;
use common\modules\credit_product\models\CreditProduct;
use common\modules\credit_product\models\CreditProductField;
use yii\base\Widget;
use yii\bootstrap\BootstrapAsset;

/**
 * @property CreditProduct $model
*/
class CustomFields extends Widget
{
    public $model;

    private $fields, $fieldsValues = [];

    public function init()
    {
        BootstrapAsset::register( $this->view );
        parent::init();
        $this->fields = CreditProductField::find()->where(['credit_product_type_id' => $this->model->getTypeId(), 'status' => StatusHelper::STATUS_PUBLISHED])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($this->fields as $field){
            $field->setProduct( $this->model );
            foreach ($field->values as $value){
                $this->fieldsValues[$field->id][] = $value;
            }
        }
    }

    public function run()
    {
        if($this->fields){
            return $this->render('custom-fields', ['fields' => $this->fields, 'model' => $this->model, 'fieldsValues' => $this->fieldsValues]);
        }
    }
}