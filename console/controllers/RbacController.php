<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 24.05.17
 * Time: 09:48
 */
class RbacController extends Controller {
    public function actionInit(){

        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $courier = $auth->createRole('courier');
        $auth->add($courier);
    }
}