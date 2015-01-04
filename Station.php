<?php

namespace Wunderground;

class Station {

	private $stationId;

	public function setStationId($id)
	{
		$this->stationId = $id;
	}

	public function getStationId()
	{
		return $this->stationId;
	}
}