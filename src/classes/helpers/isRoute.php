<?php

if(!function_exists('isRoute')) {
	function isRoute($routeName, $on_true='class="active"', $on_false="") {
		global $container;
		$currentRoute = $container->currentRoute;
		$routeName = is_array($routeName) ? $routeName : [$routeName];
		return in_array($currentRoute->getName(), $routeName) ? $on_true : $on_false;
	}
}