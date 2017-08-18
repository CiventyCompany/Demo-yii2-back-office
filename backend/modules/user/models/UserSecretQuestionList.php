<?php
namespace backend\modules\user\models;

use Yii;

class UserSecretQuestionList extends \common\modules\user\models\UserSecretQuestionList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['title'], 'required'],
            [['type', 'sort'], 'integer'],
            [['title'], 'string', 'max' => 255, 'min' => 3, 'tooShort' => Yii::t('app', 'Длинна вопроса должна быть не меньше 3 символа')],
            [['title', 'type'], 'unique', 'targetAttribute' => ['title', 'type'], 'message' => 'The combination of Title and Type has already been taken.'],
        ];
    }
}