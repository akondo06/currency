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
		$value = $this->converted_value ? $this->converted_value : $this->value;
		$yesterday = $this->yesterday ? $this->yesterday : null;
		if(!$yesterday) {
			return 0;
		}
		$yesterday_value = $this->yesterday->converted_value ? $this->yesterday->converted_value : $this->yesteday->value;
		$result = $value - $yesterday_value;

		$positive = '';
		if($result > 0) {
			$positive = "+";
		}
		return $positive.number_format($value - $yesterday_value, 4);
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
		return $query->whereDate($this->table.'.published_on', '=', $this->lastWeekDay($date))->orderBy('currency', 'desc');
	}

	public function scopeGetEquivalentValues($query, $base_currency, $amount, $filter_currencies = null, $exclude_currencies = null) {
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

		return $query->get(["*", $container['db']::raw("FORMAT(({$currency_multiplier} / `value`), 4) AS `converted_value`")]);
		/*
			Din moneda care o ai, transformi in RON si dupa imparti la cat 1 din moneda in care vrei valoarea!

			1 eur = 4.48 RON
			4.48 / 4.04 (VAL OF 1(multiplier) USD IN RON) = 1.10 USD
		*/
	}
}
