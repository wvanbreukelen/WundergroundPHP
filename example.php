<?php

require('Station.php');
require('Wunderground.php');

$station = new Wunderground\Station();

$station->setStationID("IUTRECHT71");

$wg = new Wunderground($station);

print_r($wg->current());