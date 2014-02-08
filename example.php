<?php

// Sets error reporting

error_reporting(-1);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require('station.class.php');
require('wunderground.class.php');

use WundergroundPHP\Wunderground;
use WundergroundPHP\WundergroundStation;

$wg = new Wunderground();

$ws = new WundergroundStation();
$ws->setStationId('IUTRECHT71');

echo $wg->getInfo($ws)->temp_c;