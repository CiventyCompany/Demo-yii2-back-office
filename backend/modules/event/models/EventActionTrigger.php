<?php
namespace backend\modules\event\models;

use Yii;

class EventActionTrigger extends \common\modules\event\models\EventActionTrigger
{
    public $model_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['model_name'], 'required'];
        $rules[] = [['model_name'], 'string', 'max' => 255];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['model_name'] = Yii::t('app', 'Model Name');
        return $attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->model_name = $this->model . ';' . $this->name;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $modelName = explode(';', $this->model_name);
        $this->model = $modelName[0];
        $this->name = $modelName[1];
        return parent::beforeSave($insert);
    }
}