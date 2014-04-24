<?php

class ItemsController extends BaseController {

	public function getCreate()
	{
		if (Sentry::check()) {
			$cities = City::all();
			return View::make('item.create', compact('cities'));
		}
		else
		{
			return Redirect::to('users/login')
			->with('message', 'Silahkan lakukan login/daftar terlebih dahulu.');
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
			$item->user_id = Sentry::getUser()->id;
			$item->event_id = Input::get('events');
			$item->city_id = Input::get('city');
			$item->title = Input::get('title');
			$item->description = Input::get('desc');
			$item->save();

			$image = new Image;
			$upload = Input::file('image');
			$filename = date('YmdHis').'-'.$upload->getClientOriginalName();
			Imager::make($upload->getRealPath())->resize(600, 600, true)->save('public/upload/items/'.$filename);
			Imager::make($upload->getRealPath())->resize(200, null, true)->save('public/upload/items/thumbs/'.$filename);
			$image->item_id = $item->id;
			$image->path = $filename;
			$image->save();

			$item->slug = $item->id.' '.$item->title;
			$item->save();

			return Redirect::to('/');
		}
	}

	public function getShow($id)
	{
		$items = Item::where('id', '=', $id)->get();
		$images = Image::where('item_id', '=', $id)->get();
		return View::make('item.show', compact('items', 'images'));
	}

}