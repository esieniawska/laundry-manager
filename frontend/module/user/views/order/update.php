<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/** @var $orderProducts \common\models\OrderProduct[] title */
$this->title = 'Aktualizacja zlecenia: ' . $model->id;

?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'orderProducts' => $orderProducts
    ]) ?>

</div>
