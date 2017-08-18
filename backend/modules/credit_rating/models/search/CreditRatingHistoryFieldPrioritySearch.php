<?php
namespace backend\modules\credit_rating\models\search;

use backend\modules\user\models\Profile;
use backend\modules\user\models\User;
use common\modules\credit_rating\models\CreditRatingHistoryFieldPriority;
use Yii;
use yii\data\ActiveDataProvider;

class CreditRatingHistoryFieldPrioritySearch extends CreditRatingHistoryFieldPriority
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'field' => Yii::t('app', 'Field'),
            'model' => Yii::t('app', 'Model'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field', 'model'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = self::find()->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

}