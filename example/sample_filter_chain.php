<?php

//------------------------------------
// DmImageライブラリを読み込む
//------------------------------------
require_once 'SplClassLoader.php';

// SplClassLoaderを使用する場合
$DmDirPath = '../src/';
$classLoader = new SplClassLoader(null, $DmDirPath);
$classLoader->register();

/*
// SplClassLoaderを使用せず、1ファイル毎読み込む場合
require_once $DmDirPath.'Dm/Color.php';
require_once $DmDirPath.'Dm/Image.php';
require_once $DmDirPath.'Dm/Image/Graphic/Interface.php';
require_once $DmDirPath.'Dm/Image/Graphic/Text.php';
require_once $DmDirPath.'Dm/Image/Graphic/Shape.php';
require_once $DmDirPath.'Dm/Image/File.php';
require_once $DmDirPath.'Dm/Image/Filter/Abstract.php';
require_once $DmDirPath.'Dm/Image/Filter/Fit.php';
require_once $DmDirPath.'Dm/Image/Filter/Crop.php';
require_once $DmDirPath.'Dm/Image/Filter/InstagramNormal.php';
require_once $DmDirPath.'Dm/Image/Filter/InstagramLoFi.php';
require_once $DmDirPath.'Dm/Image/Filter/InstagramWalden.php';
require_once $DmDirPath.'Dm/Image/Filter/InstagramToaster.php';
*/


//------------------------------------
// エラー出力（ここは必要に応じて）
//------------------------------------
ini_set('display_errors', 'on');
error_reporting(-1);
set_error_handler('onError');
function onError($errno, $errstr, $errfile, $errline){
	var_dump($errno, $errstr, $errfile, $errline);
	exit;
}


//------------------------------------
// サンプル
//------------------------------------
$originalImagePath = './horse.jpeg';
$width = 200;
$height = 200;
$filter = Dm_Image_Filter_Chain::create()
	->fit($width, $height, true)
	->crop($width, $height);

$image = new Dm_Image_File($originalImagePath);
$image->applyFilter($filter);

?><!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
</head>
<body>
	<div>
		元画像<br>
		<img src="<?=$originalImagePath?>">
	</div>
	<div>
		Filter適用後（縦<?=$width?> x 横<?=$height?> に収まるようにリサイズ）<br>
		<img src="<?=$image->toDataSchemeURI()?>" />
	</div>
</body>
</html>
