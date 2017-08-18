<?php

namespace backend\modules\api\models;

use common\modules\credit_rating\models\CreditRatingHistory;
use common\modules\user\models\Profile;
use common\modules\user\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "partner_fields".
 *
 * @property integer $id
 * @property integer $partner_id
 * @property string $model
 * @property string $field
 */
class PartnerFields extends ActiveRecord
{
    /**
     * Keeps models, that can be used by partners via api
     * If you need new Entity for api, just add its model here and implement it with ApiModelInterface
     * @return array
     */
    public static function getFieldsModels()
    {
        return [
            User::className(),
            Profile::className(),
            CreditRatingHistory::className(),
        ];
    }

    /**
     * Get prepared tab data for render at backend
     * @return array
     */
    public static function getTabModels()
    {
        $items = [];
        $availableModels = self::getFieldsModels();
        foreach ($availableModels as $availableModel){
            $model = new $availableModel();
            $items[] = [
                'label' => $model->getModelName(),
                'view'  => '_tab',
                'model' => $model,
            ];
        }

        return $items;
    }

    /**
     * Get all columns from table via Active Record table_schema
     * @param $model ActiveRecord
     * @return array
     */
    public static function getModelFields($model)
    {
        $columns = $model->getTableSchema()->getColumnNames();
        return $columns;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_id'], 'integer'],
            [['field'], 'safe'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Partner ID',
            'model' => 'Model',
            'field' => 'Field',
        ];
    }

    /** Save and update partner fields
     * @param $partnerId
     * @param $fields
     */
    public static function saveFields($partnerId, $fields)
    {
        PartnerFields::deleteAll(['partner_id' => $partnerId]);

        foreach ($fields as $fieldModel){
            foreach ($fieldModel as $item){
                if($item['field'] !== 'null'){
                    $saveModel = new PartnerFields();
                    $saveModel->partner_id = $partnerId;
                    $saveModel->field = $item['field'];
                    $saveModel->model = $item['model'];
                    $saveModel->save();
                }
            }
        }
    }

    /**
     * Check if radio is checked
     * @param $partnerId
     * @param $columnName
     * @param $model
     * @return bool
     */
    public static function isCheckedColumn($partnerId, $columnName, $model)
    {
        $model = PartnerFields::find()
            ->where(['partner_id' => $partnerId])
            ->andWhere(['field' => $columnName])
            ->andWhere(['model' => $model])
            ->one();

        if(!$model){
            return false;
        }

        return true;
    }

    /**
     * Prevent mysql ambiguous errors
     * @param $columnName
     * @param $model
     * @return string
     */
    public static function ambiguousColumns($columnName, $model)
    {
        $field = $columnName;

        $ambiguousColumns = [
            'id',
            'created_at',
            'updated_at'
        ];

        foreach ($ambiguousColumns as $column) {
            if (strpos($columnName, $column) !== false) {
                $field = $model::tableName() . '.' . $columnName;
            }
        }

        return $field;
    }
}
