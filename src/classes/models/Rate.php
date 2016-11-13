<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rates';

	protected $fillable = ['currency', 'currency_name', 'multiplier'];

	public function scopeTitle() {
		return $this->currency.' ('.$this->currency_name.')';
	}

	public function todayValue() {
		return $this->belongsTo('App\Models\RateValue', 'currency', 'currency')->whereDate('published_on', '<=', date('Y-m-d'))->orderBy('published_on', 'desc')->take(1);
	}

	// public function scopeValues() {
	// 	return $this->hasMany('App\Models\RateValue', 'currency')
	// 			->where('currency', $this->currency)
	// 			->orderBy('published_on', 'DESC');
	// }
}
