<?php

namespace backend\modules\user\models;

use common\modules\credit_rating\models\CreditRating;
use common\modules\credit_rating\models\CreditRatingHistory;
use common\modules\user\models\UserArchiveRelations;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\User;
use yii\helpers\ArrayHelper;

class UserSearch extends User
{
    public $fullName, $id, $phones, $passport, $last_activity_ip, $last_activity_at, $created_at;
    public $email, $m_status, $cr_from, $cr_to, $multiSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'fullName', 'phones', 'passport', 'last_activity_ip', 'last_activity_at', 'created_at'], 'string'],
            [['id', 'verified_status','m_status', 'cr_from','cr_to'], 'integer'],
            [['multiSearch'], 'safe'],
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
    public function search($params, $archive = false, $model = null)
    {
        $query = User::find()
            ->joinWith('profile')
            ->joinWith('phones');

        if($archive){
            $query->andWhere('user.in_archive = 1');
        } else {
            $query->andWhere('user.in_archive = 0');
        }

        if($model){
            if($archive){
                $field = 'archive_user_id';
                $whereField = 'user_id';
            } else {
                $field = 'user_id';
                $whereField = 'archive_user_id';
            }
            $relations = UserArchiveRelations::find()->select([$field])->where([$whereField => $model->id])->all();
            $ids = ArrayHelper::map( $relations, $field, $field);
            $query->andWhere(['in', 'user.id', $ids]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id'=>[
                    'asc'=>['id' => SORT_ASC],
                    'desc'=>['id' => SORT_DESC],
                ],
                'phones' => [
                    'asc'=>['user_phones.prefix'=>SORT_ASC, 'user_phones.code'=>SORT_ASC, 'user_phones.number'=>SORT_ASC],
                    'desc'=>['user_phones.prefix'=>SORT_DESC, 'user_phones.code'=>SORT_DESC, 'user_phones.number'=>SORT_DESC],
                ],
                'passport' => [
                    'asc'=>['profile.passport_series'=>SORT_ASC, 'profile.passport_number'=>SORT_ASC],
                    'desc'=>['profile.passport_series'=>SORT_DESC, 'profile.passport_number'=>SORT_DESC],
                ],
                'email' => [
                    'asc'=>['email' => SORT_ASC],
                    'desc'=>['email' => SORT_DESC],
                ],
                'fullName'=>[
                    'asc'=>['profile.midlename'=>SORT_ASC, 'profile.lastname'=>SORT_ASC, 'profile.firstname'=>SORT_ASC],
                    'desc'=>['profile.midlename'=>SORT_DESC, 'profile.lastname'=>SORT_DESC, 'profile.firstname'=>SORT_DESC],
                ],
                'last_activity_ip'=>[
                    'asc'=>['user.last_activity_ip'=>SORT_ASC],
                    'desc'=>['user.last_activity_ip'=>SORT_DESC],
                ],
                'last_activity_at'=>[
                    'asc'=>['user.last_activity_at'=>SORT_ASC],
                    'desc'=>['user.last_activity_at'=>SORT_DESC],
                ],
                'created_at'=>[
                    'asc'=>['user.created_at'=>SORT_ASC],
                    'desc'=>['user.created_at'=>SORT_DESC],
                ],
                'verified_status' => [
                    'asc'=>['user.verified_status'=>SORT_ASC],
                    'desc'=>['user.verified_status'=>SORT_DESC],
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
            ->andFilterWhere(['like', 'user.email', $this->email])
            ->andFilterWhere(['user.verified_status' => $this->verified_status])

            ->andFilterWhere(['like', 'profile.midlename', $this->fullName])
            ->orFilterWhere(['like', 'profile.firstname', $this->fullName])
            ->orFilterWhere(['like', 'profile.lastname', $this->fullName])

            ->andFilterWhere(['like', 'user_phones.prefix', $this->phones])
            ->orFilterWhere(['like', 'user_phones.number', $this->phones])
            ->orFilterWhere(['like', 'user_phones.code', $this->phones])

            ->andFilterWhere(['like', 'user.last_activity_ip', $this->last_activity_ip]);

            if(isset($this->last_activity_at) && !empty($this->last_activity_at)) {
                $start = strtotime('-1 day', strtotime($this->last_activity_at));
                $end = strtotime('+1 day', strtotime($this->last_activity_at));
                $query->andFilterWhere(['between', 'user.last_activity_at', $start, $end]);
            }

        if(isset($this->multiSearch) && $this->multiSearch !== ''){


            $request = explode(' ', $this->multiSearch);

            if(count($request) > 1){
                foreach ($request as $item){
                    $query
                        ->andWhere(['like', 'profile.midlename', $item])                   
                        ->orWhere(['like', 'profile.firstname', $item])
                        ->orWhere(['like', 'profile.lastname', $item])
                        ->orWhere(['like', 'user_phones.prefix', $item])
                        ->orWhere(['like', 'user_phones.number', $item])
                        ->orWhere(['like', 'user_phones.code', $item])
                        ->orWhere(['like', 'user_phones.prefix', $item])
                        ->orWhere(['like', 'user_phones.number', $item])
                        ->orWhere(['like', 'user_phones.code', $item])
                        ->orWhere(['like', 'profile.passport_series', ltrim($item, '0')])
                        ->orWhere(['like', 'profile.passport_number', $item]);
                }
            }else{
                $query
                    ->andWhere(['like', 'profile.midlename', $this->multiSearch])
                    ->orWhere(['like', 'profile.firstname', $this->multiSearch])
                    ->orWhere(['like', 'profile.lastname', $this->multiSearch])
                    ->orWhere(['like', 'user.email', $this->multiSearch])
                    ->orWhere(['like', 'profile.snils', $this->multiSearch])
                    ->orWhere(['like', 'user_phones.prefix', $this->multiSearch])
                    ->orWhere(['like', 'user_phones.number', $this->multiSearch])
                    ->orWhere(['like', 'user_phones.code', $this->multiSearch])
                    ->orWhere(['like', 'user_phones.prefix', $this->multiSearch])
                    ->orWhere(['like', 'user_phones.number', $this->multiSearch])
                    ->orWhere(['like', 'user_phones.code', $this->multiSearch])
                    ->orWhere(['like', 'profile.passport_series', ltrim($this->multiSearch, '0')])
                    ->orWhere(['like', 'profile.passport_number', $this->multiSearch]);
            }


        }

        if(isset($this->created_at) && !empty($this->created_at)) {
            $start = strtotime('-1 day', strtotime($this->created_at));
            $end = strtotime('+1 day', strtotime($this->created_at));
            $query->andFilterWhere(['between', 'user.created_at', $start, $end]);
        }

        if(isset($this->cr_from) || isset($this->cr_to)){
            $query->leftJoin( CreditRating::tableName(), 'credit_rating.user_id = user.id' );
            $query->leftJoin('(
                SELECT id, credit_rating_history.fico_coefficient, credit_rating_history.credit_rating_id
                FROM credit_rating_history
    			WHERE id = (SELECT MAX(crh2.id) FROM credit_rating_history crh2 WHERE crh2.credit_rating_id = credit_rating_history.credit_rating_id )
                GROUP BY credit_rating_history.credit_rating_id
                ) crh', 'crh.credit_rating_id = credit_rating.id');
            if(isset($this->cr_from)){
                $query->andFilterWhere(['>=', 'crh.fico_coefficient', $this->cr_from]);
            }
            if(isset($this->cr_to)){
                $query->andFilterWhere(['<=', 'crh.fico_coefficient', $this->cr_to]);
            }
        }

        if(isset($this->m_status) && $this->m_status !== '') {
            switch ($this->m_status){
                case self::M_STATUS_ACTIVE:
                        $query->andFilterWhere(['user.frozen' => 0])
                            ->andFilterWhere(['user.blocked_at' => null])
                        ->andFilterWhere(['user.deleted_at' => 0])
                        ->andFilterWhere(['user.in_archive' => 0]);
                    break;
                case self::M_STATUS_BLOCKED:
                    $query->andFilterWhere(['>','user.blocked_at' ,0]);
                    break;
                case self::M_STATUS_FROZEN:
                    $query->andFilterWhere(['not',['user.frozen' => 0]])
                        ->andFilterWhere(['not',['user.blocked_at' => null]])
                        ->andFilterWhere(['user.deleted_at' => 0]);
                    break;
                case self::M_STATUS_DELETED:
                    $query->andFilterWhere(['>','user.deleted_at' ,0]);
                    break;
                case self::M_STATUS_ARCHIVE:
                    $query->andFilterWhere(['user.in_archive' => 1]);
                    break;
            }
        }


        $query->orFilterWhere(['like', 'profile.passport_series', $this->passport])
            ->orFilterWhere(['like', 'profile.passport_number', $this->passport])
            ->andFilterWhere(['user.user.id' => $this->id])
            ->andWhere('user.confirmed_at IS NOT NULL');

        return $dataProvider;
    }
}
