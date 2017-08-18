<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\jui\DatePicker;
use backend\modules\user\models\UserInvitationEmail;

/**
 * @var \backend\modules\user\models\User $model
 */
?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' 	=> $UserInvitationEmailDataProvider,
    'filterModel'  	=> $UserInvitationEmailSearchModel,
    'layout'  		=> "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'firstname_user',
            'value' => function($model){
                return isset($model->user) ? $model->user->getFullName() : null;
            }
        ],
        'firstname',
        'email',
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:d-m-Y'],
            'filter' => DatePicker::widget([
                'model'      => $UserInvitationEmailSearchModel,
                'attribute'  => 'created_at',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'attribute' => 'status',
            'value' => function($model){
                $statuses = UserInvitationEmail::getStatusArray();
                return $statuses[ $model->status ];
            },
            'filter' => \yii\bootstrap\Html::activeDropDownList($UserInvitationEmailSearchModel, 'status', UserInvitationEmail::getStatusArray(), [
                'prompt' => '', 'class' => 'form-control'])
        ],
    ],
]);
?>

<?php Pjax::end(); ?>