<?php

require('Station.php');
require('Wunderground.php');

$station = new Wunderground\Station();

$station->setStationID("YOUR--WEATHER--STATION--ID");

$wg = new Wunderground($station);

print_r($wg->current());