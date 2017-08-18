<?php

namespace backend\modules\shop\models;


use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public $title, $description, $price, $link;
    public function rules()
    {
        return [
            [['title', 'description', 'price', 'link'], 'string']
        ];
    }

    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params, '');

        if(!$this->validate()){
            return null;
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'link', $this->link]);


        return $dataProvider;
    }
}