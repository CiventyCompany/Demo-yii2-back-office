<?php

use yii\bootstrap\ActiveForm;
use \yii\helpers\Html;

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model]); ?>
