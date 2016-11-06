<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rates';

	protected $fillable = ['currency', 'multiplier'];

	// public function scopeValues() {
	// 	return $this->hasMany('App\Models\RateValue', 'currency')
	// 			->where('currency', $this->currency)
	// 			->orderBy('published_on', 'DESC');
	// }
}


// <?php namespace App\Models;

// use DB;
// use Illuminate\Database\Eloquent\Model;

// class ExchangeRate extends Model {

//     protected $table = 'exchange_rates';

// 	protected $fillable = ['currency_code', 'currency_name', 'rate'];

// 	public function country_dial_codes()
//     {
//         return $this->hasMany('App\Models\CountryDialCode');
//     }

//     public function scopeGetEquivalentRate($query, $base_currency_code, $amount, $filter_currencies)
//     {
//         $base_currency = $this->whereCurrencyCode($base_currency_code)->first();
//         $currency_multiplier = $amount / $base_currency->rate;
//         $query->whereIn('currency_code', $filter_currencies);
//         $result = $query->get(["*", DB::raw("FORMAT((`rate` * {$currency_multiplier}), 2) AS `converted_rate`")]);
//         return $result;
//     }
// }
