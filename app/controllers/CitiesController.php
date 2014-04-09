<?php

class CitiesController extends BaseController {

	public function getIndex()
	{
		return $cities = City::all();
	}

}