<?php

use common\models\Order;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var  $waitingAtCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var  $waitingForReturnToCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var  $travelToLaundryDataProvider \yii\data\ActiveDataProvider */
/* @var  $travelToCustomerDataProvider \yii\data\ActiveDataProvider */




$this->title = Yii::$app->name;
?>

<div class="courier-index">
    <div class="container">
        <?php Pjax::begin(['enablePushState' => false]); ?>
        <h4>Do odebrania od klienta: </h4>
        <?= GridView::widget([
            'dataProvider' => $waitingAtCustomerDataProvider,
            'responsive' => true,
            'pjax' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'user_id',
                    'value' => function (Order $model) {
                        return $model->user->username;
                    }
                ],
                'created_at',
                'updated_at',
                'address',
                [
                    'attribute' => 'status',
                    'value' => function (Order $model) {
                        return $model->getStatusLabel();
                    }
                ],
                ['class' => 'yii\grid\ActionColumn',

                    'template' => '{travel-to-laundry}',
                    'buttons' => [
                        'travel-to-laundry' => function ($url, $model) {
                            return Html::a(FA::icon('mail-forward').' Zawieź do pralni', ['travel-to-laundry', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']);
                        },
                    ],
                ],
            ],
        ]); ?>

        <h4>W podróży do pralni: </h4>
        <?= GridView::widget([
            'dataProvider' => $travelToLaundryDataProvider,
            'responsive' => true,
            'pjax' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'user_id',
                    'value' => function (Order $model) {
                        return $model->user->username;
                    }
                ],
                'created_at',
                'updated_at',
                'address',
                [
                    'attribute' => 'status',
                    'value' => function (Order $model) {
                        return $model->getStatusLabel();
                    }
                ],
            ],
        ]); ?>
        <h4>Do odebrania z pralni: </h4>

        <?= GridView::widget([
            'dataProvider' => $waitingForReturnToCustomerDataProvider,
            'responsive' => true,
            'pjax' => true,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'user_id',
                    'value' => function (Order $model) {
                        return $model->user->username;
                    }
                ],
                'created_at',
                'updated_at',
                'address',
                [
                    'attribute' => 'status',
                    'value' => function (Order $model) {
                        return $model->getStatusLabel();
                    }
                ],

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{travel-to-customer}',
                    'buttons' => [
                        'travel-to-customer' => function ($url, $model) {
                            return Html::a(FA::icon('reply-all').' Zawieź do klienta', ['travel-to-customer', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']);
                        },
                    ],
                ],
            ],
        ]); ?>

        <h4>W podróży do klienta: </h4>
        <?= GridView::widget([
            'dataProvider' => $travelToCustomerDataProvider,
            'responsive' => true,
            'pjax' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'user_id',
                    'value' => function (Order $model) {
                        return $model->user->username;
                    }
                ],
                'created_at',
                'updated_at',
                'address',
                [
                    'attribute' => 'status',
                    'value' => function (Order $model) {
                        return $model->getStatusLabel();
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>
