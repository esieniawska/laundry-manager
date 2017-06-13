<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {
    public $sourcePath = '@frontend/assets';


    public $css = [
        'css/site.css',
        'css/font-awesome.css',
        'css/frontend-css.scss',
    ];
    public $js = [
        'js/site.js',
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
