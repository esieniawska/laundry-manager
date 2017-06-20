<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $orderProducts \common\models\OrderProduct[] */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin([
    'enableReplaceState'=>false,
    'enablePushState'=>false,
]); ?>
<div class="order-form">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'options'=>[
            'data-pjax'=>true,
        ]
    ]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>



    <?php foreach ($orderProducts as $index => $orderProduct) { ?>

        <?= $form->errorSummary($orderProduct) ?>

        <div class="col-xs-6">
            <?= $form->field($orderProduct, "[$index]product_id")->dropDownList(ArrayHelper::map(\common\models\Product::find()->all(), 'id', 'name')) ?>
        </div>

        <div class="col-xs-6">
            <?= $form->field($orderProduct, "[$index]amount")->textInput() ?>
        </div>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Dodaj produkt', ['name' => 'addRow', 'value' => 'true', 'class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end()?>