<?php

/* @var $this yii\web\View */
/* @var  $orderDataProvider \yii\data\ActiveDataProvider */
/* @var  $waitingAtCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var $travelToLaundryDataProvider \yii\data\ActiveDataProvider */
/* @var  $waitingForWashDataProvider \yii\data\ActiveDataProvider */
/* @var $washDataProvider \yii\data\ActiveDataProvider */
/* @var  $waitingForReturnToCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var  $travelToCustomerDataProvider \yii\data\ActiveDataProvider */
/* @var  $receivingByCustomerDataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="col-xs-12">
        <h4>Ilość moich zleceń:
            <?= $orderDataProvider->count ?></h4>
    </div>
    <div class="col-xs-12">
        <h5>A w tym: </h5>
        <p> - oczekujących na odbiór od klienta:<?=' ' . $waitingAtCustomerDataProvider->count ?></p>
        <p> - transport do pralni:<?= ' ' . $travelToLaundryDataProvider->count ?></p>
        <p> - oczekujących na pranie:<?= ' ' . $waitingForWashDataProvider->count ?></p>
        <p> - pranych:<?= ' ' . $washDataProvider->count ?></p>
        <p> - oczekujących na transport do klienta:<?= ' ' . $waitingForReturnToCustomerDataProvider->count ?></p>
        <p> - transport do klienta:<?= ' ' . $travelToCustomerDataProvider->count ?></p>
        <p> - odebrane przez klienta:<?= ' ' . $receivingByCustomerDataProvider->count ?></p>

    </div>
</div>
