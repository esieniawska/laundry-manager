<?php

use common\models\Order;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var  $waitingAtCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var  $waitingForReturnToCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var  $travelToLaundryDataProvider \yii\data\ActiveDataProvider */
/* @var  $travelToCustomerDataProvider \yii\data\ActiveDataProvider */


$this->title = Yii::$app->name;
?>

<div class="courier-index">
    <div class="container">

        <div class="text-center">
        <h4>  Aktualnie realizowane zlecenia</h4>
        </div>

        <?php Pjax::begin(['enablePushState' => false]); ?>

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
                    'format' => 'html',
                    'value' => function (Order $model) {
                        return "<div class=\"" . $model->getStatusCSSClass() . "\">" . $model->getStatusLabel() . "</div>";
                    }

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
                    'format' => 'html',
                    'value' => function (Order $model) {
                        return "<div class=\"" . $model->getStatusCSSClass() . "\">" . $model->getStatusLabel() . "</div>";
                    }

                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>
