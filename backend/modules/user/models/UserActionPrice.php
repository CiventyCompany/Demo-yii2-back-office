<?php

namespace backend\modules\user\models;

use Yii;

class UserActionPrice extends \common\modules\user\models\UserActionPrice
{
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['name', 'link', 'price', 'description', 'title'], 'string'],
        ];
    }

    public function attributeLabels()
    {
       return [
           'id' => \Yii::t('app', 'ID'),
           'name' => Yii::t('app', 'Message'),
           'price' => Yii::t('app', 'Price'),
           'title' => Yii::t('app', 'Title'),
           'description' => Yii::t('app', 'Description'),
           'link' => Yii::t('app', 'Link')
       ];
    }
}