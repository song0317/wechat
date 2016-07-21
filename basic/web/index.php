<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

//判断是否安装
// define('IA_DIR', str_replace("\\",'/', __DIR__.'/../'));
if(file_exists('../install/install.lock')){
	include('demo.php');
	//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />·如果你还没安装本程序，请运行<a href='../install/install.php'> install.php 进入安装&gt;&gt; </a><br/><br/>&nbsp;&nbsp;<a href='' style='font-size:12px' target='_blank'>Power by WT &nbsp;微Two公众平台自助开源引擎</a>
    //header("location:../install/install.php");
    die;
}
// else{
	// echo 12;
// }
//结束
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
