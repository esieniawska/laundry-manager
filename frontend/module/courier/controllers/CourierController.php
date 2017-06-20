<?php

namespace frontend\module\courier\controllers;

use common\models\Order;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `module` module
 */
class CourierController extends Controller {
    /**
     * Renders the index view for the module
     * @return string
     */


    public function actionIndex() {
        $this->layout = 'main-courier';

        $waitingQuery = Order::find()
            ->waitingAtCustomer();

        $waitingAtCustomerDataProvider = new ActiveDataProvider([
            'query' => $waitingQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $waitingForReturnToCustomerQuery = Order::find()
            ->waitingForReturnToCustomer();

        $travelToLaundryQuery = Order::find()
            ->travelToLaundry();
        $travelToLaundryDataProvider = new ActiveDataProvider([
            'query' => $travelToLaundryQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);


        $waitingForReturnToCustomerDataProvider = new ActiveDataProvider([
            'query' => $waitingForReturnToCustomerQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $travelToCustomerQuery = Order::find()
            ->travelToCustomer();
        $travelToCustomerDataProvider = new ActiveDataProvider([
            'query' => $travelToCustomerQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);


        return $this->render('index', [
            'waitingAtCustomerDataProvider' => $waitingAtCustomerDataProvider,
            'waitingForReturnToCustomerDataProvider' => $waitingForReturnToCustomerDataProvider,
            'travelToLaundryDataProvider'=>$travelToLaundryDataProvider,
            'travelToCustomerDataProvider'=>$travelToCustomerDataProvider,
        ]);
    }

    public function actionOrder(){
        $this->layout = 'main-courier';

        $waitingQuery = Order::find()
            ->waitingAtCustomer();

        $waitingAtCustomerDataProvider = new ActiveDataProvider([
            'query' => $waitingQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $waitingForReturnToCustomerQuery = Order::find()
            ->waitingForReturnToCustomer();


        $waitingForReturnToCustomerDataProvider = new ActiveDataProvider([
            'query' => $waitingForReturnToCustomerQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);


        return $this->render('order',[
                'waitingAtCustomerDataProvider' => $waitingAtCustomerDataProvider,
                'waitingForReturnToCustomerDataProvider' => $waitingForReturnToCustomerDataProvider,

        ]);
}
    public function actionTravelToLaundry($id){
        Order::setTravelToLaundryStatus($id);
        return $this->actionOrder();
    }

    public function actionTravelToCustomer($id){
        Order::setTravelToCustomerStatus($id);
        return $this->actionOrder();
    }
}
