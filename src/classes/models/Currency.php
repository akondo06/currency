<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

	protected $table = 'currencies';

	protected $fillable = ['currency', 'currency_name', 'multiplier'];

	public function scopeTitle() {
		return $this->currency.' ('.$this->currency_name.')';
	}

	// public function todayValue() { // not correct!
	// 	return $this->belongsTo('App\Models\RateValue', 'currency', 'currency')->whereDate('published_on', '<=', date('Y-m-d'))->groupBy('currency')->orderBy('published_on', 'desc')->take(1);
	// }

	// public function values() {
	// 	return $this->hasMany('App\Models\RateValue', 'currency', 'currency')
	// 			->where('currency', $this->currency)
	// 			->orderBy('published_on', 'DESC')->get();
	// }
}
