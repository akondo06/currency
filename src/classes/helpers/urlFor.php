<?php

if(!function_exists('urlFor')) {
	function urlFor($routeName, $data=[]) {
		global $container;
		return $container->router->pathFor($routeName, (array) $data);
	}
}