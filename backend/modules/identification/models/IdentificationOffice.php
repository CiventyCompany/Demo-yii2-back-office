<?php
namespace backend\modules\identification\models;

use backend\behaviors\UploadFileBehavior;
use common\modules\identification\models\IdentificationMethodCity;
use Yii;

class IdentificationOffice extends \common\modules\identification\models\IdentificationOffice
{
    public function attributeLabels()
    {
        return [
            'city_id' => Yii::t('app', 'City'),
            'identification_method_id' => Yii::t('app', 'Method'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'mode' => Yii::t('app', 'Mode'),
            'photo' => Yii::t('app', 'Photo'),
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'identification_method_id', 'address', 'phone', 'mode'], 'required'],
            [['city_id', 'identification_method_id'], 'integer'],
            [['address', 'phone', 'mode', 'photo'], 'string', 'max' => 255],
            [['city_id', 'address'], 'unique', 'targetAttribute' => ['city_id', 'address']],
            /*
            [['new_photo'], 'required', 'when' => function($model){
                return ( $this->isNewRecord && !$_FILES['IdentificationOffice']['size']['new_photo'] ) ? true : false;
            }],
            */
            [['new_photo'], 'safe'],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        IdentificationMethodCity::insertIgnore( $this->identification_method_id, $this->city_id );
    }
}
