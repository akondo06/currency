<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateValue extends Model {

	protected $table = 'rate_values';

	protected $fillable = ['published_on', 'currency', 'value'];

	public function rate() {
		return $this->BelongsTo('App\Models\Rate', 'currency', 'currency');
	}

	public function scopeGetEquivalentValue($query, $base_currency, $amount, $filter_currencies = null) {
		global $container;
		$base_currency = $this->whereCurrency($base_currency)->first();
		$currency_multiplier = $amount / $base_currency->value;
		if($filter_currencies != null) {
			$query->whereIn('currency', $filter_currencies);
		}
		$result = $query->get(["*", $container['db']::raw("FORMAT((`value` * {$currency_multiplier}), 4) AS `converted_value`")]);
		return $result;

		/*
			Din moneda care o ai, transformi in RON si dupa imparti la cat 1 din moneda in care vrei valoarea!

			1 eur = 4.48 RON
			4.48 / 4.04 (VAL OF 1(multiplier) USD IN RON) = 1.10 USD
		*/
	}
}
