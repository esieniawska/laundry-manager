<?php

use common\models\Order;
use common\models\OrderProduct;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title ='Zlecenie nr '. $model->id;

?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="order-status">
        <?php if ($model->status == Order::STATUS_TRAVEL_TO_LAUNDRY) {
            echo Html::a('Potwierdź przyjęcie zlecenia', ['waiting-for-wash', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']);
        } else if ($model->status == Order::STATUS_WAITING_FOR_WASH) {
            echo Html::a('Pranie', ['wash', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']);

        } else if ($model->status == Order::STATUS_WASHING) {
            echo Html::a('Zamów kuriera', ['waiting-for-return', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']);
        }

        ?>

        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Jesteś pewien, że chcesz usunąć to zlecenie?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => function (Order $model) {
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Order $model) {
                    return $model->getStatusLabel();
                }
            ],
            'created_at',
            'updated_at',
            'address',
        ],
    ]) ?>



    <?= GridView::widget([
        'dataProvider' => $orderProductsDataProvider,
        'responsive' => true,
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'product_id',
                'value' => function (OrderProduct $model) {
                    return $model->product->name;
                }
            ],
            'amount',

        ],
    ]); ?>

</div>
