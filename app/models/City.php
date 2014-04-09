<?php

class City extends Eloquent {

	protected $fillable = [];

	/**
	 * Models relationship
	 */
	public function user()
	{
		return $this->hasMany('User');
	}

}