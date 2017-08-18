<?php
use yii\widgets\DetailView;

/**
 * @var \common\modules\credit_rating\models\CreditRatingHistory $model
*/
if(!$model){
    return;
}

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'created_at',
        'fico_coefficient',
        'dynamics',
        'open_credits',
        'guarantor',
        [
            'attribute' => 'amount_total',
            'value' => $model->getTotalAmount() . ' руб.',
        ],
        [
            'attribute' => 'amount_to_be_paid',
            'value' => $model->getAmountToBePaid() . ' руб.',
        ],
        'bad_debt',
        'delay_open_small',
        'delay_open_middle',
        'delay_open_big',
        'delay_closed_small',
        'delay_closed_middle',
        'delay_closed_big',
        'requests_last_seven_days',
        'requests_last_fourteen_days',
        'requests_last_month_days',
        'requests_all',
    ]
]);
?>