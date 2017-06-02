<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 29.05.17
 * Time: 14:42
 */

namespace common\models;


use yii\db\ActiveQuery;

class OrderQuery extends ActiveQuery {


    public function forUserId($userId) {
        $this->andWhere('user_id = :userId',
            [
                ':userId' => $userId
            ]);
        return $this;
    }

    public function forStatus($status) {
        return $this->andWhere('status = ' . $status);
    }

    public function waitingAtCustomer() {
        return $this->forStatus(Order::STATUS_WAITING_AT_CUSTOMER);
    }

    public function travelToLaundry() {
        return $this->forStatus(Order::STATUS_TRAVEL_TO_LAUNDRY);
    }

    public function waitingForWash() {
        return $this->forStatus(Order::STATUS_WAITING_FOR_WASH);
    }

    public function washing() {
        return $this->forStatus(Order::STATUS_WASHING);
    }

    public function waitingForReturnToCustomer() {
        return $this->forStatus(Order::STATUS_WAITING_FOR_RETURN_TO_CUSTOMER);
    }

    public function travelToCustomer() {
        return $this->forStatus(Order::STATUS_TRAVEL_TO_CUSTOMER);
    }

    public function receivingByCustomer() {
        return $this->forStatus(Order::STATUS_RECEIVING_BY_CUSTOMER);
    }

}