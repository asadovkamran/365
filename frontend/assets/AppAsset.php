<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{

  

    public $basePath = '@webroot';
    public $baseUrl = '@web';
   // public $sourcePath = '@vendor';
    public $css = [
        'css/custom365/jquery-ui.min.css',
        'css/jquery-ui-custom.css',
        'css/style.css',
        'css/media-queries.css',
        'css/car-class-choice.css',
        'css/loader.css',
        'css/bootstrap-datetimepicker-custom.css',
        'css/site-preloader.css'
    ];
//    public $jsOptions = ['position'=>\yii\web\view::POS_HEAD];
    public $js = [
        'scripts/birthdayPicker.js',
        'scripts/script.js',
        
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyBB19cyGLWQeSz1amgo9wJN6ZeXlQtHZCU&signed_in=true&libraries=places&callback=Autocomplete&language=en'
        
    ];
     public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset', 
        'yii\jui\JuiAsset',
    ];
     
}
