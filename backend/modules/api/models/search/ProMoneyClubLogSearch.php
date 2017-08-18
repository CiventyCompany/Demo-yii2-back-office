<?php
namespace backend\modules\api\models\search;

use backend\modules\api\models\ProMoneyClubLog;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProMoneyClubLogSearch extends ProMoneyClubLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'midlename', 'birthday', 'passport', 'passport_date', 'data'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'firstname'=>[
                    'asc'=>['firstname' => SORT_ASC],
                    'desc'=>['firstname' => SORT_DESC],
                ],
                'lastname' => [
                    'asc'=>['lastname'=>SORT_ASC],
                    'desc'=>['lastname'=>SORT_DESC],
                ],
                'midlename' => [
                    'asc'=>['midlename'=>SORT_ASC],
                    'desc'=>['midlename'=>SORT_DESC],
                ],
                'birthday' => [
                    'asc'=>['birthday' => SORT_ASC],
                    'desc'=>['birthday' => SORT_DESC],
                ],
                'passport'=>[
                    'asc'=>['passport'=>SORT_ASC],
                    'desc'=>['passport'=>SORT_DESC],
                ],
                'passport_date'=>[
                    'asc'=>['passport_date'=>SORT_ASC],
                    'desc'=>['passport_date'=>SORT_DESC],
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query
            ->andFilterWhere(['like', 'firstnamel', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'midlename', $this->midlename])
            ->andFilterWhere(['birthday' => $this->birthday])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['passport_date' => $this->passport_date]);

        return $dataProvider;
    }
}
