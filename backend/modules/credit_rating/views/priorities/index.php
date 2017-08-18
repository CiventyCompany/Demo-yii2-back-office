<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var array $data */

$this->title = Yii::t('app', 'Priorities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priorities-index">
    <p>
        <?= Html::a( Yii::t('app', 'Update'), ['update'], ['class' => 'btn btn-primary'] ) ?>
    </p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Модели</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $field => $item): ?>
            <tr>
                <td><?= $item['label'] ?></td>
                <td>

                    <?php foreach ($item['models'] as $model){ ?>
                        <?php $model = $model->model; ?>
                        <?= \common\helpers\ClassHelper::getClassName( $model::className() ) ?> <br />
                    <?php } ?>
                </td>
                <td><?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'field' => $field]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
