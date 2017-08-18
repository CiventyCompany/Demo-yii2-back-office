<?php

namespace backend\modules\api\models;

use backend\modules\user\models\User;
use Yii;
use yii\base\ErrorException;
use yii\db\Exception;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $description
 * @property string $access_token
 * @property string $select_fields
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['access_token'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'user_id' => Yii::t('app','User'),
            'access_token' => Yii::t('app','Access Token'),
            'select_fields' => Yii::t('app','Select Fields'),
            'description' => 'Bнутреннее примечание',
        ];
    }

    /**
     * Generate unique Partner-User access token
     * @return void
     */
    public function generateToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString(200);
        try {
            $this->save();
        } catch (Exception $e) {
            $this->access_token = Yii::$app->security->generateRandomString(200);
        }
    }

    /**
     * Get partner username for backend idex table
     * @return string
     */
    public function getUserName()
    {
        $model = User::findOne(['id' => $this->user_id]);
        if(!$model){
            return '-';
        }
        return $model->username;
    }

    /**
     * Prepare select field list
     * @param $model
     * @return bool|string
     */
    public static function preparedFieldList($model)
    {
        $fields = PartnerFields::find()
            ->select('field')
            ->where(['model' => $model])
            ->andWhere(['partner_id' => self::getPartnerId()])
            ->asArray()
            ->all();

        $preparedFields = [];
        foreach ($fields as $field){
            $preparedFields[] = $field['field'];
        }

        if(!$preparedFields){
            return false;
        }
        return implode(',',$preparedFields);
    }

    /**
     * Just get partner id from user
     * @return int|array
     * @throws ErrorException
     */
    public static function getPartnerId()
    {
        $model = Partners::findOne(['user_id' => Yii::$app->user->id]);
        if(!$model) {
            return [
                'res' => false,
                'error' => 'Error parnhers.php'
            ];
        }
        return $model->id;
    }
}
