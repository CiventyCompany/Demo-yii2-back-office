<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var array $data */

$this->title = Yii::t('app', 'Update model field - ') . $field;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$items = [];
function cmp($a, $b)
{
    if ($a['priority'] == $b['priority']) {
        return 0;
    }
    return ($a['priority'] > $b['priority']) ? -1 : 1;
}
usort($data, 'cmp');
//print_r($data); exit;
?>
<div class="priorities-update">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $priority = count($data);
    foreach ($data as $item){
        $items[] = $this->render('_sortable-item', ['item' => $item, 'model' => $model, 'priority' => $priority--]);
    }
    ?>

    <?= \yii\jui\Sortable::widget([
        'items' => $items,
        'options' => ['tag' => 'ul', 'id' => 'priority-sortable'],
        'itemOptions' => ['tag' => 'li', 'class' => 'list-group-item'],
        'clientOptions' => ['cursor' => 'move'],
        'clientEvents' => [
            'stop' => 'function (event) { 
                setTimeout(function(){
                    var count = $("#priority-sortable li").length;
                    $("#priority-sortable li").each(function(index){
                        $(this).find("input[name=\"CreditRatingHistoryFieldPriority[priority][]\"]").val( count-- );
                    });
                }, 200);                
             }'
        ],
    ]); ?>

    <p>
        <?= \yii\bootstrap\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
