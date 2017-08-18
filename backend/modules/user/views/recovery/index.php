<?php
use yii\data\ActiveDataProvider;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var \backend\modules\user\models\search\UserRecoveryLogSearch $searchModel
 */

$this->title = Yii::t('app', 'Recovery');
$this->params['breadcrumbs'][] = $this->title;
$items = [];
$tabsLinks = [
    [
        'label' => Yii::t('app', 'All'),
        'alias' => 'index'
    ],
    [
        'label' => Yii::t('app', 'Moderation'),
        'alias' => 'moderation'
    ],
    [
        'label' => Yii::t('app', 'Completed'),
        'alias' => 'completed'
    ],
];

foreach ($tabsLinks as $tabsLink){
    $item = [];
    $item['label'] = $tabsLink['label'];
    if(Yii::$app->controller->action->id == $tabsLink['alias']){
        $item['content'] = $this->render('_index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
        $item['active'] = true;
    } else {
        $item['url'] = ['/user/recovery/' . $tabsLink['alias']];
    }
    $items[] = $item;
}

?>
<?= \yii\bootstrap\Tabs::widget([
    'items' => $items
]);?>
