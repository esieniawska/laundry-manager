<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zlecenia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

    <h1><?= Html::encode($this->title) ?></h1>

<p>Masz <?=$dataProvider->count. ' zleceń'?></p>
    <p>
        <?= Html::a('Utwórz nowe zlecenie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'address',
            'status',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
<div id="app">
    {{ message }}
</div>

<div id="app-2">
  <span v-bind:title="message">
    Hover your mouse over me for a few seconds
    to see my dynamically bound title!
  </span>
</div>

<div id="app-3">
    <p v-if="seen">Now you see me</p>
</div>