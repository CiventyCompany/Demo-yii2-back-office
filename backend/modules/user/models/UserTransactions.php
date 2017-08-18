<?php
namespace backend\modules\user\models;

use common\modules\user\models\UserTransaction;
use Yii;

class UserTransactions extends UserTransaction
{
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Sum'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id'])->via('user');
    }

    public static function getStatus($status = null)
    {
        $statusArray = [ self::STATUS_NOT_PAID => Yii::t('app', 'Not paid'), self::STATUS_PAID => Yii::t('app', 'Paid')];

        if(isset($status) && is_numeric($status) && key_exists($status, $statusArray)){
            if($status == self::STATUS_PAID){
                return "<div class='label label-success'>$statusArray[$status]</div>";
            }elseif($status == self::STATUS_NOT_PAID){
                return "<div class='label label-warning'>$statusArray[$status]</div>";
            }
            return $statusArray[$status];
        }
        return $statusArray;
    }

}