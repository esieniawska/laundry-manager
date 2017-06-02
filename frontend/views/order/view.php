<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use \common\models\OrderProduct;
use common\models\Order;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $user \common\models\User */

$this->title = 'Zlecenie nr: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->status == Order::STATUS_WAITING_AT_CUSTOMER) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Jesteś pewien, że chcesz usunąć to zlecenie?',
                    'method' => 'post',
                ],
            ]); ?>
        <?php } ?>

    </p>
    <?php Pjax::begin(['enablePushState' => false]); ?>
    <p>  <?= 'Data utworzenia: ' . $model->created_at ?></p>
    <p> <?= 'Status zlecenia: ' . $model->getStatusLabel() ?></p>
    <p>  <?= 'Aktualizacja: ' . $model->updated_at ?></p>


    <?php if ($user == $model->user_id && $model->status == Order::STATUS_TRAVEL_TO_CUSTOMER) {
        echo Html::a('Potwierdź odbiór', ['receiving', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']);
    } ?>


    <?php Pjax::end(); ?>

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
