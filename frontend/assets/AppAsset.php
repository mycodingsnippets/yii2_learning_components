<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    
    //    We can register separate assets for specific usage also in different files
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'summernote/summernote.min.css',
        'jquery-ui/jquery-ui.min.css'
    ];
    public $js = [
        'summernote/summernote.min.js',
        'js/app.js',
        'jquery-ui/jquery-ui.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
