<?php

use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Utwórz zlecenie';
?>


<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'orderProducts'=>$orderProducts,
    ]) ?>

</div>
