<?php

class HilangController extends BaseController {

	public function getIndex()
	{
		//$hilang = Hilang::all();
		return View::make('hilang.index');
	}

}