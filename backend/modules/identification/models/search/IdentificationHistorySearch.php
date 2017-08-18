<?php
namespace backend\modules\identification\models\search;

use backend\modules\identification\models\IdentificationHistory;
use backend\modules\user\models\Profile;
use backend\modules\user\models\User;
use common\modules\identification\models\IdentificationMethod;
use common\modules\shop\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class IdentificationHistorySearch extends IdentificationHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'identification_method_id', 'status'], 'integer'],
            [['created_at', 'user_id'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = self::find()->joinWith('user');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->user_id){
            $userTable = User::tableName();
            $profileTable = Profile::tableName();
            $query->leftJoin( $profileTable, $profileTable . '.user_id = ' . $userTable . '.id' );
            $query->andWhere( "CONCAT_WS(' ', {$profileTable}.firstname, {$profileTable}.midlename, {$profileTable}.lastname) LIKE '%{$this->user_id}'" );
        }

        if(isset($this->created_at) && !empty($this->created_at)) {
            $dateFrom = new \DateTime( $this->created_at );
            $dateTo = new \DateTime( $this->created_at );
            $dateFrom->modify('-1 day');
            $dateTo->modify('+2 day');
            $query->andFilterWhere(['between', self::tableName() . '.created_at', $dateFrom->format('Y-m-d H:i:s'), $dateTo->format('Y-m-d H:i:s')]);
        }

        if(isset($this->closed_at) && !empty($this->closed_at)) {
            $dateFrom = new \DateTime( $this->closed_at );
            $dateTo = new \DateTime( $this->closed_at );
            $dateFrom->modify('-1 day');
            $dateTo->modify('+2 day');
            $query->andFilterWhere(['between', self::tableName() . '.created_at', $dateFrom->format('Y-m-d H:i:s'), $dateTo->format('Y-m-d H:i:s')]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'identification_method_id' => $this->identification_method_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}