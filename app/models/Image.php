<?php

class Image extends Eloquent {

	public function item()
	{
		return $this->belongsTo('Item');
	}

}