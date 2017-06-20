<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $sourcePath = '@backend/assets';


    public $css = [
        'css/site.css',
    ];

    public $js = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];

    public function init() {
        parent::init();
        $this->publishOptions['forceCopy'] = true;
    }
}
