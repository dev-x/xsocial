<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//xcdn.webstart.in.ua/css/prettyPhoto.css',
        'css/site_stepan.css',
    ];
    public $js = [
        '//xcdn.webstart.in.ua/js/underscore.js',
        '//xcdn.webstart.in.ua/js/backbone.js',
        '//xcdn.webstart.in.ua/js/widgEditor.js',
        '//xcdn.webstart.in.ua/js/jquery.prettyPhoto.js',
        'js/jq.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
