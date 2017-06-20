<?php

namespace frontend\module\user\controllers;

use common\models\Order;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class UserController extends Controller {
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex() {
        $this->layout = 'main-user';

        $user = Yii::$app->user->getId();

        $orderQuery = Order::find()
            ->forUserId($user)
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);

        $orderDataProvider = new ActiveDataProvider([
            'query' => $orderQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $waitingQuery = Order::find()
            ->forUserId($user)
            ->waitingAtCustomer();
        $waitingAtCustomerDataProvider = new ActiveDataProvider([
            'query' => $waitingQuery,
        ]);

        $travelToLaundryDataProvider = new ActiveDataProvider();
        $travelToLaundryDataProvider->query = Order::find()
            ->forUserId($user)
            ->travelToLaundry();

        $waitingForWashDataProvider = new ActiveDataProvider();
        $waitingForWashDataProvider->query = Order::find()
            ->forUserId($user)
            ->waitingForWash();

        $washDataProvider = new ActiveDataProvider();
        $washDataProvider->query = Order::find()
            ->forUserId($user)
            ->washing();

        $waitingForReturnToCustomerDataProvider = new ActiveDataProvider();
        $waitingForReturnToCustomerDataProvider->query = Order::find()
            ->forUserId($user)
            ->waitingForReturnToCustomer();

        $travelToCustomerDataProvider = new ActiveDataProvider();
        $travelToCustomerDataProvider->query = Order::find()
            ->forUserId($user)
            ->travelToCustomer();

        $receivingByCustomerDataProvider = new ActiveDataProvider();
        $receivingByCustomerDataProvider->query = Order::find()
            ->forUserId($user)
            ->receivingByCustomer();


        return $this->render('index', [
            'waitingAtCustomerDataProvider' => $waitingAtCustomerDataProvider,
            'orderDataProvider' => $orderDataProvider,
            'travelToLaundryDataProvider' => $travelToLaundryDataProvider,
            'waitingForWashDataProvider' => $waitingForWashDataProvider,
            'washDataProvider' => $washDataProvider,
            'waitingForReturnToCustomerDataProvider' => $waitingForReturnToCustomerDataProvider,
            'travelToCustomerDataProvider' => $travelToCustomerDataProvider,
            'receivingByCustomerDataProvider' => $receivingByCustomerDataProvider,
        ]);
    }


}
