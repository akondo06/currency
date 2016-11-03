<?php
if(!function_exists('public_path')) {
	function public_path($file='/') {
		return __DIR__ . '/../../public/'.$file;
	}
}

if(!function_exists('elixir')) {
	/**
	 * Get the path to a versioned Elixir file.
	 *
	 * @param  string  $file
	 * @return string
	 *
	 * @throws \InvalidArgumentException
	 */
	function elixir($file)  {
		static $manifest = null;

		if(is_null($manifest)) {
			$manifest = json_decode(file_get_contents(public_path('build/rev-manifest.json')), true);
		}


		if(isset($manifest[$file])) {
			return '/build/'.$manifest[$file];
		}

		throw new InvalidArgumentException("File {$file} not defined in asset manifest.".__DIR__);
	}
}