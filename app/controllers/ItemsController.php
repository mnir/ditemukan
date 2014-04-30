<?php

class ItemsController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

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
			'city'     => 'required',
			'event'    => 'required',
			'title'       => 'required',
			'description' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('items/create')->withErrors($validator)->withInput();
		}
		else
		{
			$item = new Item;
			$item->user_id = Sentry::getUser()->id;
			$item->event_id = Input::get('event');
			$item->city_id = Input::get('city');
			$item->title = Input::get('title');
			$item->description = Input::get('description');

			// Untuk input image path di halaman daftar item
			$cover = Input::file('image');
			if($cover)
			{
				$filename = date('YmdHis').'-'.$cover->getClientOriginalName();
				Imager::make($cover->getRealPath())->grab(80)->save('public/upload/items/covers/'.$filename);
				$item->image = $filename;
			}

			$item->save();

			$item->slug = $item->id.' '.$item->title;
			$item->save();

			$upload = Input::file('image');
			if($upload)
			{
				$image = new Image;
				$filename = date('YmdHis').'-'.$upload->getClientOriginalName();
				Imager::make($upload->getRealPath())->resize(600, 600, true)->save('public/upload/items/'.$filename);
				Imager::make($upload->getRealPath())->resize(200, null, true)->save('public/upload/items/thumbs/'.$filename);
				$image->item_id = $item->id;
				$image->path = $filename;
				$image->save();
			}

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