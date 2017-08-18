<?php

namespace backend\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%order_items}}".
 *
 * @property integer $order_id
 * @property integer $product_id
 *
 * @property Order $order
 */
class OrderItems extends \common\modules\shop\models\OrderItems
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }
}
