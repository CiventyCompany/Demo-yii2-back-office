<?php
namespace backend\modules\identification\models;

use backend\modules\shop\models\Product;
use common\modules\identification\models\IdentificationMethod;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class IdentificationHistory extends \common\modules\identification\models\IdentificationHistory
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'identification_method_id' => Yii::t('app', 'Method'),
            'user_id' => Yii::t('app', 'User'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'city_id' => Yii::t('app', 'City'),
            'closed_at' => Yii::t('app', 'Closed At'),
        ];
    }

    public function getStatusText($type = null)
    {
        $statuses = $this->getStatuses();
        $str = '';
        $status = $statuses[ $this->status ];
        if(!$type){
            switch ($this->status){
                case self::STATUS_NEW:
                    $str = "<div class=\"label label-warning\">{$status}</div>";
                    break;
                case self::STATUS_SUCCESS:
                    $str = "<div class=\"label label-success\">{$status}</div>";
                    break;
                case self::STATUS_CLOSED:
                    $str = "<div class=\"label label-danger\">{$status}</div>";
                    break;
            }
            return $str;
        }

        return $status;
    }

    public function getIdentificationMethods()
    {
        $results = (new Query())
            ->select([IdentificationMethod::tableName() . '.id', Product::tableName() . '.title'])
            ->from(IdentificationMethod::tableName())
            ->innerJoin(Product::tableName(), IdentificationMethod::tableName() . '.product_id = ' . Product::tableName() . '.id')
            ->all();
        return ArrayHelper::map( $results, 'id', 'title' );
    }

    public function getStatuses()
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'In Process'),
            self::STATUS_CLOSED => Yii::t('app', 'Status Closed'),
            self::STATUS_SUCCESS => Yii::t('app', 'Identified'),
        ];
    }
}