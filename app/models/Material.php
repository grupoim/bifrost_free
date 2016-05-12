<?php

class Material extends Eloquent {
	protected $table = 'material';
	public $timestamps = false;


	public function materialcolor() {
		return $this->hasOne('MaterialColor','material_id');
	}
}