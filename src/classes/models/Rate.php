<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rates';

	protected $fillable = ['currency', 'currency_name', 'multiplier'];

	public function scopeTitle() {
		return $this->currency.' ('.$this->currency_name.')';
	}

	// public function scopeValues() {
	// 	return $this->hasMany('App\Models\RateValue', 'currency')
	// 			->where('currency', $this->currency)
	// 			->orderBy('published_on', 'DESC');
	// }
}
