<?php

class ItemsController extends BaseController {

	public function getIndex()
	{
		//
	}

	public function getCreate()
	{
		if (Auth::check()) {
			$cities = City::all();
			return View::make('item.create', compact('cities'));
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function postCreate()
	{
		$rules = array(
			'city'   => 'required',
			'events' => 'required',
			'title'  => 'required|min:5',
			'desc'   => 'required|min:5'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('item/create')->withErrors($validator)->withInput();
		}
		else
		{
			$item = new Item;
			$item->user_id = Auth::user()->id;
			$item->event_id = Input::get('events');
			$item->city_id = Input::get('city');
			$item->title = Input::get('title');
			$item->description = Input::get('desc');
			$item->save();

			$item->slug = $item->id.' '.$item->title;
			$item->save();

			return Redirect::to('/');
		}
	}

}