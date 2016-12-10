var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) { 
	var bootstrapPath = './node_modules/bootstrap-sass/assets';
	mix.sass('./resources/scss/app.scss', './public/css/app.css')
		.copy('./resources/img', './public/img')
		.scripts('./resources/js/app.js', './public/js/app.js')
		.version(['./public/css/app.css', './public/js/app.js'])
		.copy(bootstrapPath + '/fonts', 'public/fonts') 
		.copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js')
		.copy('./resources/img', './public/build/img')
		.browserSync({
			proxy: {
				target: 'http://127.0.0.1/currency/public/',
			}
		});
});
