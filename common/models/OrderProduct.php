<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $amount
 *
 * @property Order $order
 * @property Product $product
 */
class OrderProduct extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product_id', 'amount'], 'required'],
            [['order_id', 'product_id', 'amount'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'Zamówienie',
            'product_id' => 'Produkt',
            'amount' => 'Ilość',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder() {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}
