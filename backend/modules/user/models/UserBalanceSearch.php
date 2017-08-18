<?php
namespace backend\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserBalanceSearch extends UserBalance
{
    public $fullBalance, $local, $external;

    public function rules()
    {
        return [
            [['local', 'external'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels()['fullBalance'] = \Yii::t('app', 'Full balance');
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param $model object
     *
     * @return ActiveDataProvider
     */
    public function search($params, $model = null)
    {
        $query = UserBalance::find()->where(['user_id' => $model->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'local'=>[
                    'asc'=>['local' => SORT_ASC],
                    'desc'=>['local' => SORT_DESC],
                ],
                'external'=>[
                    'asc'=>['external' => SORT_ASC],
                    'desc'=>['external' => SORT_DESC],
                ],
//                'fullBalance' => [
//                    'asc'=>['fullBalance'=>SORT_ASC],
//                    'desc'=>['fullBalance'=>SORT_DESC],
//                ],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'external', $this->external]);


        return $dataProvider;
    }
}