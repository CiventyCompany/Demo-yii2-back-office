<?php

namespace backend\modules\user\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "{{%user_transaction}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $status
 *
 * @property User $user
 */
class UserTransaction extends \common\modules\user\models\UserTransaction
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
