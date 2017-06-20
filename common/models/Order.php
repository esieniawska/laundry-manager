<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\bootstrap\Html;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property string $address
 * @property integer $status
 *
 * @property User $user
 * @property OrderProduct[] $orderProducts
 * @property Product[] $products
 */
class Order extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */

    const STATUS_WAITING_AT_CUSTOMER = 0;
    const STATUS_TRAVEL_TO_LAUNDRY = 1;
    const STATUS_WAITING_FOR_WASH = 2;
    const STATUS_WASHING = 3;
    const STATUS_WAITING_FOR_RETURN_TO_CUSTOMER = 4;
    const STATUS_TRAVEL_TO_CUSTOMER = 5;
    const STATUS_RECEIVING_BY_CUSTOMER = 6;

    public static function tableName() {
        return 'order';
    }

    public static function getStatusLabels() {
        return [
            self::STATUS_WAITING_AT_CUSTOMER => "Oczekiwanie na odbiór od klienta",
            self::STATUS_TRAVEL_TO_LAUNDRY => "Transport do pralni",
            self::STATUS_WAITING_FOR_WASH => "Oczekiwanie na pranie",
            self::STATUS_WASHING => "W trakcie prania",
            self::STATUS_WAITING_FOR_RETURN_TO_CUSTOMER => "Oczekuje na transport do klienta",
            self::STATUS_TRAVEL_TO_CUSTOMER => "Transport do klienta",
            self::STATUS_RECEIVING_BY_CUSTOMER => "Odebrane przez klienta",
        ];
    }

    public function getStatusLabel() {
        $status = self::getStatusLabels();
        return $status[$this->status];
    }



    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['address'], 'required'],
            [['user_id', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'status', 'products'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],

        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'Użytkownik',
            'created_at' => 'Utworzono',
            'updated_by'=>'Aktualizowane przez',
            'updated_at' => 'Aktualizowano',
            'address' => 'Adres',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy(){
        return $this->hasOne(User::className(),['id'=>'updated_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    public function getOrderProducts() {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('order_product', ['order_id' => 'id']);
    }

    public function setWaitingStatus() {
        $this->status = self::STATUS_WAITING_AT_CUSTOMER;
        return $this;
    }

    public function setStatus($orderId, $status){
        $order = Order::findOne($orderId);
        $order->status = $status;
        $order->save();
    }

    public static function setTravelToLaundryStatus($id){
        Order::setStatus($id, self::STATUS_TRAVEL_TO_LAUNDRY );
    }

    public static function setWaitingForWashStatus($id){
        Order::setStatus($id, self::STATUS_WAITING_FOR_WASH );
    }

    public static function setWashingStatus($id){
        Order::setStatus($id, self::STATUS_WASHING );
    }

    public static function setWaitingForReturnToCustomerStatus($id){
        Order::setStatus($id, self::STATUS_WAITING_FOR_RETURN_TO_CUSTOMER );
    }

    public static function setTravelToCustomerStatus($id){
        Order::setStatus($id, self::STATUS_TRAVEL_TO_CUSTOMER );
    }

    public static function setReceivingByCustomerStatus($id){
        Order::setStatus($id, self::STATUS_RECEIVING_BY_CUSTOMER );
    }

    /**
     * @return OrderQuery
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

}
