<?php

class City extends Eloquent {

	protected $fillable = [];

	/**
	 *  Setting Model Relationship
	 */
	public function item() { return $this->hasMany('item'); }

}