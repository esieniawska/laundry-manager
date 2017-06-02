<?php

namespace frontend\controllers;

use common\models\OrderForm;
use common\models\OrderProduct;

use Throwable;
use Yii;
use common\models\Order;
use common\models\OrderSearch;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\Transaction;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex() {

        $user = Yii::$app->user->getId();

        $query = Order::find()
            ->where('user_id = :userId', [
                'userId' => $user,
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $user = Yii::$app->user->getId();

        $query = OrderProduct::find()
            ->where('order_id = :id', ['id' => $id]);

        $orderProductsDataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'user'=>$user,
            'orderProductsDataProvider' => $orderProductsDataProvider,
        ]);
    }

    public function actionReceiving($id){
        Order::setReceivingByCustomerStatus($id);
        return $this->actionView($id);
    }


    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {


        $order = new Order();

        $orderProducts = [new OrderProduct()];

        $orderProductsRows = Yii::$app->request->post('OrderProduct', []);

        if (count($orderProductsRows) > 0) {
            $orderProducts = [];
        }

        foreach ($orderProductsRows as $i => $orderProductData) {
            $orderProduct = new OrderProduct();
            $orderProduct->setAttributes($orderProductData);
            $orderProducts[] = $orderProduct;
        }

        if (Yii::$app->request->post('addRow')) {
            $order->load(Yii::$app->request->post());

            $orderProducts[] = new OrderProduct();

            return $this->render('create', [
                'model' => $order,
                'orderProducts' => $orderProducts
            ]);
        }

        if ($order->load(Yii::$app->request->post())) {
            $t = Yii::$app->db->beginTransaction();
            try {

                $validateMultiple = Model::validateMultiple($orderProducts);
                $validate = $order->validate();
                if ($validate && $validateMultiple) {
                    $order->setWaitingStatus();
                    $order->save(false);

                    foreach ($orderProducts as $orderProduct) {
                        $orderProduct->order_id = $order->id;
                        $orderProduct->save(false);
                    }

                    $t->commit();

                    return $this->redirect(['view', 'id' => $order->id]);
                }

            } catch (Exception $exception) {
                $t->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $order,
            'orderProducts' => $orderProducts

        ]);

    }


    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $order = $this->findModel($id);
        $orderProducts = $order->orderProducts;

        $orderProductsRows = Yii::$app->request->post('OrderProduct', []);

        if (count($orderProductsRows) > 0) {
            $orderProducts = [];
        }

        foreach ($orderProductsRows as $i => $orderProductData) {

            $orderProduct = new OrderProduct();
            $orderProduct->setAttributes($orderProductData);
            $orderProducts[] = $orderProduct;

        }

        if (Yii::$app->request->post('addRow')) {
            $order->load(Yii::$app->request->post());

            $orderProducts[] = new OrderProduct();

            return $this->render('update', [
                'model' => $order,
                'orderProducts' => $orderProducts
            ]);
        }

        if ($order->load(Yii::$app->request->post())) {
            $t = Yii::$app->db->beginTransaction();
            try {

                $validateMultiple = Model::validateMultiple($orderProducts);
                $validate = $order->validate();
                if ($validate && $validateMultiple) {
                    $order->setWaitingStatus();
                    $order->save(false);

                    OrderProduct::deleteAll(array('order_id' => $id));
                    foreach ($orderProducts as $orderProduct) {
                        $orderProduct->order_id = $order->id;
                        $orderProduct->save(false);
                    }

                    $t->commit();

                    return $this->redirect(['view', 'id' => $order->id]);
                }

            } catch (Exception $exception) {
                $t->rollBack();
            }
        }
        return $this->render('update', [
            'model' => $order,
            'orderProducts' => $orderProducts
        ]);

    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
