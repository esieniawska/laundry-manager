<?php

use common\models\Order;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var  $model Order */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zlecenia';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (Order $model) {

                    return "<div class=\"" . $model->getStatusCSSClass() . "\">" . $model->getStatusLabel() . "</div>";
                }

            ],
            'created_at',
            'updated_at',
            'address',

            ['class' => 'yii\grid\ActionColumn',

                'template' => '{view}{waiting-for-wash}{wash}{waiting-for-return}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(FA::icon('eye'), ['view', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm ']);

                    },
                    'waiting-for-wash' => function ($url, $model) {
                        if ($model->status == Order::STATUS_TRAVEL_TO_LAUNDRY) {
                            return Html::a(FA::icon('spinner') . ' Potwierdż przyjęcie', ['waiting-for-wash', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm label-waiting-wash']);
                        }
                    },
                    'wash' => function ($url, $model) {
                        if ($model->status == Order::STATUS_WAITING_FOR_WASH) {
                            return Html::a(FA::icon('tint') . ' Pranie', ['wash', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm label-wash']);
                        }
                    },
                    'waiting-for-return' => function ($url, $model) {
                        if ($model->status == Order::STATUS_WASHING) {
                            return Html::a(FA::icon('truck') . ' Zamów kuriera', ['waiting-for-return', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm label-waiting-return']);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
