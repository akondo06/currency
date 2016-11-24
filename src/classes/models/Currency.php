<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

	protected $table = 'currencies';

	protected $fillable = ['currency', 'name', 'multiplier'];

	public function scopeTitle() {
		return $this->currency.' ('.$this->name.')';
	}

	public function todayValue() { // not correct!
		return $this->belongsTo('App\Models\Rate', 'currency', 'currency')->onDate(previousWeekDay(date('Y-m-d')))->take(1);
	}

	public function scopeExcludeBase($query) {
		return $query->whereNotIn('currency', ['RON']);
	}

	// public function values() {
	// 	return $this->hasMany('App\Models\Rate', 'currency', 'currency')
	// 			->where('currency', $this->currency)
	// 			->orderBy('published_on', 'DESC')->get();
	// }
}
