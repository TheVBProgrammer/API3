<?php
namespace jucksearm\theme\devoops;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/jucksearm/yii2-theme-devoops/assets';
    public $css = [
        'plugins/bootstrap/bootstrap.css',
        'plugins/jquery-ui/jquery-ui.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        //'plugins/fancybox/jquery.fancybox.css',
        //'plugins/fullcalendar/fullcalendar.css',
        //'plugins/xcharts/xcharts.min.css',
        //'plugins/select2/select2.css',
        //'plugins/justified-gallery/justifiedGallery.css',
        //'plugins/chartist/chartist.min.css',
        'css/style.css',
    ];
    public $js = [
        'plugins/jquery-ui/jquery-ui.min.js',
        'plugins/bootstrap/bootstrap.min.js',
        //'plugins/justified-gallery/jquery.justifiedGallery.min.js',
        //'plugins/tinymce/tinymce.min.js',
        //'plugins/tinymce/jquery.tinymce.min.js',
        //'js/devoops.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
