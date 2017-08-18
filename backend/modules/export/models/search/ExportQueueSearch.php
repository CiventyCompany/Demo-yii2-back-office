<?php
namespace backend\modules\export\models\search;

use backend\modules\user\models\User;
use backend\modules\export\models\ExportQueue;
use common\modules\user\models\Profile;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ExportQueueSearch extends ExportQueue
{
    public $created_at_from, $created_at_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'status', 'user_id', 'created_at_from', 'created_at_to'], 'safe'],
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
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if( $this->user_id ){
            $users = User::find()
                ->alias('u')
                ->select(['u.id'])
                ->leftJoin( Profile::tableName() . ' p', 'p.user_id = u.id' )
                ->where('CONCAT_WS(" ", p.firstname, p.midlename, p.lastname) LIKE "%' . $this->user_id . '%"')
                ->limit(20)
                ->all();
            if( !count($users) ){
                $query->andWhere(['user_id' => -1]);
            } else {
                $query->andWhere(['in', 'user_id', ArrayHelper::map($users, 'id', 'id')]);
            }
        }

        if(isset($this->created_at_from) && !empty($this->created_at_from)){
            $query->andFilterWhere(['>=', 'created_at', date('Y-m-d', strtotime($this->created_at_from))]);
        }

        if(isset($this->created_at_to) && !empty($this->created_at_to)){
            $query->andFilterWhere(['<=', 'created_at', date('Y-m-d', strtotime($this->created_at_to) + 86400)]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
