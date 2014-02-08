<?php

namespace WundergroundPHP;

use WundergroundPHP\WundergroundStation;

class Wunderground {

	public function getInfo(WundergroundStation $station)
	{
		$xmlSource = $this->resolveStationUrl($station->getStationId());

		return $this->createStationArray($xmlSource);
	}

	protected function createStationArray($xmlSource)
	{
		return simplexml_load_file($xmlSource);
	}

	protected function resolveStationUrl($stationID)
	{
		return 'http://api.wunderground.com/weatherstation/WXCurrentObXML.asp?ID=' . $stationID;
	}
}
