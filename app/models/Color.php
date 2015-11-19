<?php

class Color extends Eloquent {
	protected $table = 'color';
	public $timestamps = false;


	public function materialcolor() {
		return $this->hasOne('MaterialColor', 'color_id');
	}
}