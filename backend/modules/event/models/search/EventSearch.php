<?php
namespace backend\modules\event\models\search;

use Yii;
use backend\modules\event\models\EventHandler;
use yii\base\Model;
use yii\data\ArrayDataProvider;

class EventSearch extends Model
{
    public $group, $label;

    private $items = [], $groups = [], $labels = [];

    public function init()
    {
        $eventHandler = new EventHandler();
        foreach ($eventHandler->getAllEventsList() as $group => $items){
            $groupName = Yii::t('app', $group);
            $this->groups[ $groupName ] = $groupName;
            foreach($items as $item){
                $labelName = Yii::t('app', $item['label']);
                $this->labels[ $labelName ] = $labelName;
                $this->items[] = (object)[
                    'group' => $groupName,
                    'label' => $labelName,
                    'model' => Yii::t('app', $item['model']),
                    'name' => Yii::t('app', $item['name']),
                ];
            }
        }
        $this->items = array_unique($this->items, SORT_REGULAR);
        //echo '<pre>'; print_r( $this->items ); exit;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group', 'label'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'group' => Yii::t('app', 'Module'),
            'label' => Yii::t('app', 'Event'),
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
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @inheritdoc
     */
    public function search( $params )
    {
        $this->load($params);

        //echo '<pre>'; print_r( $this ); exit;
        if($this->group){
            $this->items = array_filter($this->items, function ($item){
                return $this->group == $item->group;
            });
        }

        //echo '<pre>'; print_r( $this ); exit;

        if($this->label){
            $this->items = array_filter($this->items, function ($item){
                return $this->label == $item->label;
            });
        }

        usort($this->items, function ($a, $b){
            if($a->group == $b->group){
                return strcmp($a->label, $b->label);
            }
            return strcmp($a->group, $b->group);
        });

        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->items,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}