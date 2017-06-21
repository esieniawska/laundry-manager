<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 13.06.17
 * Time: 10:39
 * @var  $waitingAtCustomerDataProvider \yii\data\ActiveDataProvider
 * @var  $waitingForReturnToCustomerDataProvider \yii\data\ActiveDataProvider
 */

use common\models\Order;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::$app->name;
?>

<div class="courier-order">
    <div class="container">

        <div class="text-center">
            <div class="btn btn-active   " id="waiting-at-customer-button">
                <div class="title">Oczekujące na odbiór od klienta</div>

            </div>
            <div class="btn btn-site " id="waiting-for-return-button">
                <div class="title">Oczekujące na odbiór z pralni</div>
            </div>
        </div>
        <div class="waiting-at-customer-list">

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
                    'format' => 'html',
                    'value' => function (Order $model) {

                        return "<div class=\"" . $model->getStatusCSSClass() . "\">" . $model->getStatusLabel() . "</div>";
                    }

                ],
                ['class' => 'yii\grid\ActionColumn',

                    'template' => '{travel-to-laundry}',
                    'buttons' => [
                        'travel-to-laundry' => function ($url, $model) {
                            return Html::a(FA::icon('mail-forward').' Zawieź do pralni', ['travel-to-laundry', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm label-travel-laundry']);
                        },
                    ],
                ],
            ],
        ]); ?>

        </div>

        <div class="waiting-for-return-list">


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
                    'format' => 'html',
                    'value' => function (Order $model) {
                        return "<div class=\"" . $model->getStatusCSSClass() . "\">" . $model->getStatusLabel() . "</div>";
                    }

                ],

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{travel-to-customer}',
                    'buttons' => [
                        'travel-to-customer' => function ($url, $model) {
                            return Html::a(FA::icon('reply-all').' Zawieź do klienta', ['travel-to-customer', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm label-travel-customer']);
                        },
                    ],
                ],
            ],
        ]); ?>

        </div>


    </div>

</div>