<?php

namespace backend\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\UserActionPrice;

class UserActionPriceSearch extends UserActionPrice
{
    public $id,
        $name,
        $price,
        $title,
        $description,
        $link;

    public function rules()
    {
        return [
            [['name', 'title', 'description', 'link'], 'string'],
            [['price', 'id'], 'integer']
        ];
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = UserActionPrice::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id'=>[
                    'asc'=>['id' => SORT_ASC],
                    'desc'=>['id' => SORT_DESC],
                ],
                'name'=>[
                    'asc'=>['name' => SORT_ASC],
                    'desc'=>['name' => SORT_DESC],
                ],
                'title' => [
                    'asc'=>['title'=>SORT_ASC],
                    'desc'=>['title'=>SORT_DESC],
                ],
                'description' => [
                    'asc'=>['description' => SORT_ASC],
                    'desc'=>['description' => SORT_DESC],
                ],
                'link' => [
                    'asc'=>['link' => SORT_ASC],
                    'desc'=>['link' => SORT_DESC],
                ],
                'price' => [
                    'asc'=>['price' => SORT_ASC],
                    'desc'=>['price' => SORT_DESC],
                ],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['id' => $this->id]);


        return $dataProvider;
    }

}