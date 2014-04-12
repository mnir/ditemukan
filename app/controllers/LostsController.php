<?php

class LostsController extends BaseController {

	public function getIndex()
	{
		$items = Item::where('event_id', 1)->get();
		return View::make('lost.index', compact('items'));
	}

}