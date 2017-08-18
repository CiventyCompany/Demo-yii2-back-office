<?php

namespace backend\modules\credit_rating\models\search;

use common\modules\credit_rating\models\CreditRatingHistory;
use Yii;
use yii\base\Event;
use yii\base\Exception;
use yii\data\ActiveDataProvider;

/**
 * @inheritdoc
 */
class CreditRatingHistorySearch extends CreditRatingHistory
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['month'], 'string'],
            [['month', 'fico_coefficient', 'dynamics', 'open_credits', 'guarantor', 'amount_total', 'amount_to_be_paid',
                'bad_debt', 'delay_open_small', 'delay_open_middle', 'delay_open_big', 'delay_closed_small',
                'delay_closed_middle', 'delay_closed_big', 'requests_last_seven_days', 'requests_last_fourteen_days',
                'requests_last_month_days', 'requests_all'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param $model object
     *
     * @return ActiveDataProvider
     */
    public function search($params, $credit_rating = null)
    {
        $query = self::find();
        if( is_object($credit_rating) ){
            $query->where(['credit_rating_id' => $credit_rating->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'fico_coefficient', $this->fico_coefficient])
            ->andFilterWhere(['=', 'dynamics', $this->dynamics])
            ->andFilterWhere(['=', 'open_credits', $this->fico_coefficient])
            ->andFilterWhere(['=', 'guarantor', $this->fico_coefficient])
            ->andFilterWhere(['>=', 'amount_total', $this->fico_coefficient])
            ->andFilterWhere(['>=', 'amount_to_be_paid', $this->fico_coefficient])
            ->andFilterWhere(['=', 'bad_debt', $this->fico_coefficient])
            ->andFilterWhere(['=', 'delay_open_small', $this->fico_coefficient])
            ->andFilterWhere(['=', 'delay_open_middle', $this->fico_coefficient])
            ->andFilterWhere(['=', 'delay_open_big', $this->fico_coefficient])
            ->andFilterWhere(['=', 'delay_closed_small', $this->fico_coefficient])
            ->andFilterWhere(['=', 'delay_closed_middle', $this->fico_coefficient])
            ->andFilterWhere(['=', 'delay_closed_big', $this->fico_coefficient])
            ->andFilterWhere(['=', 'requests_last_seven_days', $this->fico_coefficient])
            ->andFilterWhere(['=', 'requests_last_fourteen_days', $this->fico_coefficient])
            ->andFilterWhere(['=', 'requests_last_month_days', $this->fico_coefficient])
            ->andFilterWhere(['=', 'requests_all', $this->fico_coefficient]);

        if(isset($this->month) && !empty($this->month)) {
            $date = new \DateTime();
            $date->setTimestamp( strtotime($this->month) );
            $query->andFilterWhere(['between', 'month', $date->modify('-15 day')->format('Y-m-d'), $date->modify('+30 day')->format('Y-m-d')]);
        }

        return $dataProvider;
    }

}
