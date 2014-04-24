 <?php

class FoundsController extends BaseController {

	public function getIndex()
	{
		$items = Item::where('event_id', 2)->get();
		return View::make('found.index', compact('items'));
	}

}