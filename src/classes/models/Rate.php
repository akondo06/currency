<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rates';

	protected $fillable = ['published_on', 'currency', 'value'];

	public function currencyObj() {
		return $this->belongsTo('App\Models\Currency', 'currency', 'currency');
	}

	public function variation() {
		$value = isset($this->converted_value) ? $this->converted_value : $this->value;
		$yesterday = isset($this->yesterday) ? $this->yesterday : null;
		if(!$yesterday) {
			return 0;
		}
		$yesterday_value = isset($yesterday->converted_value) ? $yesterday->converted_value : $yesterday->value;
		$result = $value - $yesterday_value;

		$positive = '';
		if($result > 0) {
			$positive = "+";
		}
		return $positive.number_format($value - $yesterday_value, 4);
	}

	public function scopeOnDate($query, $date = null) {
		return $query->whereDate($this->table.'.published_on', '=', previousWeekDay($date))->orderBy('currency', 'desc')->groupBy('currency');
	}

	public function scopeBetweenDates($query, $start_date = null, $end_date = null, $order = 'asc') {
		return $query
			->whereDate('published_on', '>=', previousWeekDay($start_date))
			->whereDate('published_on', '<=', previousWeekDay($end_date))
			->orderBy('published_on', $order);
	}

	/*
		Given the amount 1 and RON as base currency, when reverse = true:
			Gets the value of amount in RON of each currency
	*/
	public function scopeGetEquivalentValues($query, $base_currency, $amount, $filter_currencies = null, $exclude_currencies = null, $reverse = false) {
		global $container;
		if($filter_currencies != null) {
			$query->whereIn('currency', $filter_currencies);
		}
		if(!$exclude_currencies) {
			$exclude_currencies = [$base_currency];
		}
		$query->whereNotIn('currency', $exclude_currencies);

		$base_currency = $this->whereCurrency($base_currency)->first();
		$currency_multiplier = $amount * $base_currency->value;

		$converted_value = "{$currency_multiplier} / `value`";
		if($reverse) {
			$converted_value = "`value` / {$currency_multiplier}";
		} 

		return $query->get(["*", $container['db']::raw("FORMAT(({$converted_value}), 4) AS `converted_value`")]);
		/*
			Din moneda care o ai, transformi in RON si dupa imparti la cat 1 din moneda in care vrei valoarea!

			1 eur = 4.48 RON
			4.48 / 4.04 (VAL OF 1(multiplier) USD IN RON) = 1.10 USD
		*/
	}
}
