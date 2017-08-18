<?php

namespace backend\modules\shop\models;

use backend\behaviors\UploadFileBehavior;
use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 */
class Product extends \common\modules\shop\models\Product
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Product title'),
            'description' => Yii::t('app', 'Description'),
            'full_description' => Yii::t('app', 'Full Description'),
            'price' => Yii::t('app', 'Price product'),
            'link' => Yii::t('app', 'Link product'),
            'image' => Yii::t('app', 'Image'),
            'image_width' => Yii::t('app', 'Image Width'),
            'image_height' => Yii::t('app', 'Image Height'),
        ];
    }
}
