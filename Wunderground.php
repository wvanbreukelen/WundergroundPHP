<?php

use Wunderground\Station as WundergroundStation;

class Wunderground 
{

	protected $station;

	protected $data;

	public function __construct(WundergroundStation $station)
	{
		$this->setStation($station);

		$this->download();
	}

	/**
	 * Get the current weather
	 * @return array The current weather as an array
	 */
	public function current()
	{
		$data = $this->data;

		return array(
			'temp_c' => $data['temp_c'],
			'temp_f' => $data['temp_f'],
			'hum' => $data['relative_humidity'] . "%",
			'wind_cond' => $data['wind_string'],
			'wind_degree' => $data['wind_degrees'],
			'wind_dir' => $data['wind_dir'],
			'wind_mph' => $data['wind_mph'] . " mp/h",
			'wind_kph' => (int) $data['wind_mph'] * 3.6 . " km/h",
			'wind_gust_mph' => $data['wind_gust_mph'] . " mp/h",
			'wind_gust_kph' => $data['wind_gust_mph'] * 3.6 . " km/h",
			'pressure_str' => $data['pressure_string'],
			'pressure_mb' => $data['pressure_mb'] . " mb",
			'pressure_in' => $data['pressure_in'] . "'",
			'dewpoint_str' => $data['dewpoint_string'],
			'dewpoint_f' => $data['dewpoint_f'],
			'dewpoint_c' => $data['dewpoint_c'], 
		);
	}

	/**
	 * Download the new Wunderground data
	 * @return mixed
	 */
	public function download()
	{
		$this->data = $this->getData();
	}
	
	/**
	 * Get the latest data from the Wunderground API
	 * @return array
	 */
	public function getData()
	{
		$xmlSource = $this->resolveStationUrl($this->station->getStationId());

		$parsed = $this->parseRawData($xmlSource);

		// Small check if station exists
		if (is_array($parsed['relative_humidity']) && count($parsed['relative_humidity']) === 0)
		{
			throw new Exception("The station " . $this->station->getStationId() . " does not exists!");
		}

		return $parsed;
	}

	public function setStation(WundergroundStation $station)
	{
		$this->station = $station;
	}

	public function getStation()
	{
		return $this->station;
	}

	protected function resolveStationUrl($stationID)
	{
		return 'http://api.wunderground.com/weatherstation/WXCurrentObXML.asp?ID=' . $stationID;
	}

	protected function parseRawData($xmlSource)
	{
		$xml = simplexml_load_file($xmlSource);

		return json_decode(json_encode($xml), true);
	}
}
