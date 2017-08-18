<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\jui\DatePicker;

/**
 * @var \backend\modules\credit_rating\models\search\CreditRatingHistorySearch $CreditRatingHistorySearch
 * @var \yii\data\ActiveDataProvider $CreditRatingHistorySearchDataProvider
 */
?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $CreditRatingHistorySearchDataProvider,
    'filterModel'  	=> $CreditRatingHistorySearch,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'label' => Yii::t('app','Date of update'),
            'attribute' => 'month',
            'format' => ['date', 'php:d-m-Y G:i:s'],
            'filter' => DatePicker::widget([
                'model'      => $CreditRatingHistorySearch,
                'attribute'  => 'month',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        'fico_coefficient',
        'dynamics',
        'open_credits',
        'guarantor',
        'amount_total',
        'amount_to_be_paid',
        'bad_debt',
        'delay_open_small',
        'delay_open_middle',
        'delay_open_big',
        'delay_closed_small',
        'delay_closed_middle',
        'delay_closed_big',
        'requests_last_seven_days',
        'requests_last_fourteen_days',
        'requests_all',
    ],
]);
?>

<?php Pjax::end(); ?>