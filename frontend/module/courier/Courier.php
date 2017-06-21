<?php

namespace frontend\module\courier;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * module module definition class
 */
class Courier extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\module\courier\controllers';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'courier'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

    }


}
