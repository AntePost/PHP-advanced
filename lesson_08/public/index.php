<?php
use App\main\App;

$config = include($_SERVER['DOCUMENT_ROOT'] .'/../main/config.php');
include $config['vendorPath'] .'autoload.php';
App::call()->run($config);

