<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rates';

    protected $fillable = ['published_on', 'currency', 'multiplier', 'value'];

	/*
		currency
		multiplier .. usually 1. . but for some currencies like the japaneese yen .. its 100
		value
		published_on - date published by the bank ...
	*/
}
