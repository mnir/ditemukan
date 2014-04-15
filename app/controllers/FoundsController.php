 <?php

class FoundsController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', ['on'=>'post']);
	}

	public function getIndex()
	{
		$items = Item::where('event_id', 2)->get();
		return View::make('found.index', compact('items'));
	}

}