<?php
namespace backend\modules\identification\models\search;

use common\modules\identification\models\IdentificationMethod;
use common\modules\location\models\City;
use common\modules\shop\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class IdentificationOfficeSearch extends \common\modules\identification\models\search\IdentificationOfficeSearch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'identification_method_id', 'address', 'phone', 'mode', 'photo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city_id' => Yii::t('app', 'City'),
            'identification_method_id' => Yii::t('app', 'Method'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'mode' => Yii::t('app', 'Mode'),
            'photo' => Yii::t('app', 'Photo'),
        ];
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
            'pagination' => [
                'pageSize' => $this->limit,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'identification_method_id' => $this->identification_method_id,
        ]);

        if($this->city_id){
            $query->leftJoin( City::tableName(), City::tableName() . '.city_id = ' . self::tableName() . '.city_id' );
            $query->andWhere( City::tableName().".name LIKE '{$this->city_id}%'" );
        }

        $query
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mode', $this->mode])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }

}