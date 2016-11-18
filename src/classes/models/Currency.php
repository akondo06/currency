<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

	protected $table = 'currencies';

	protected $fillable = ['currency', 'name', 'multiplier'];

	public function scopeTitle() {
		return $this->currency.' ('.$this->name.')';
	}

	// public function todayValue() { // not correct!
	// 	return $this->belongsTo('App\Models\Rate', 'currency', 'currency')->whereDate('published_on', '<=', date('Y-m-d'))->groupBy('currency')->orderBy('published_on', 'desc')->take(1);
	// }

	// public function values() {
	// 	return $this->hasMany('App\Models\Rate', 'currency', 'currency')
	// 			->where('currency', $this->currency)
	// 			->orderBy('published_on', 'DESC')->get();
	// }
}
