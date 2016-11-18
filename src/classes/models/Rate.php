<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rates';

	protected $fillable = ['published_on', 'currency', 'value'];

	public function currencyObj() {
		return $this->belongsTo('App\Models\Currency', 'currency', 'currency');
	}

	private function lastWeekDay($date = null) {
		$date = new \DateTime($date);
		$date_final = $date->format('Y-m-d');

		while((date('N', strtotime($date_final)) >= 6)) {
			$date->sub(\DateInterval::createFromDateString('1 day'));
			$date_final = $date->format('Y-m-d');
		}

		return $date_final;
	}

	public function scopeOnDate($query, $date = null) {
		return $query->whereDate('published_on', '=', $date);
	}

	public function scopeGetEquivalentValues($query, $base_currency, $amount, $filter_currencies = null, $exclude_currencies = null) {
		global $container;
		if($filter_currencies != null) {
			$query->whereIn('currency', $filter_currencies);
		}
		if($exclude_currencies != null) {
			$query->whereNotIn('currency', $exclude_currencies);
		}
		
		$base_currency = $this->whereCurrency($base_currency)->first();
		$currency_multiplier = $amount * $base_currency->value;

		return $query->get(["*", $container['db']::raw("FORMAT(({$currency_multiplier} / `value`), 4) AS `converted_value`")]);
		/* Might not be accurate with the currencies that have a different multiplier than 1 ... like JPY check that! */
		/*
			Din moneda care o ai, transformi in RON si dupa imparti la cat 1 din moneda in care vrei valoarea!

			1 eur = 4.48 RON
			4.48 / 4.04 (VAL OF 1(multiplier) USD IN RON) = 1.10 USD
		*/
	}
}
