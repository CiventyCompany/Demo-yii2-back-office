<?php
namespace backend\modules\location\models\search;

use common\modules\location\models\City;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'city_id'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        if (!$this->validate()) {

            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'city_id' => $this->city_id,
            'region_id' => $this->region_id,
        ]);

        if($this->name){
            $query->andWhere("name LIKE '{$this->name}%'");
        }

        return $dataProvider;
    }

}