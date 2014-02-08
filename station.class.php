<?php

namespace WundergroundPHP;

class WundergroundStation {

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