/* Charts */
var chartColors = {
	chart1: '#c1c106',
	chart2: '#ff0000',
	chart3: '#0d8ecf'
};

AmCharts.translations.ro = {
	'monthNames': ['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'],
	'shortMonthNames': ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	'dayNames': ['Duminică', 'Luni', 'Marţi', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
	'shortDayNames': ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sb'],
	'zoomOutText': 'Arată tot'
};
AmCharts.translations.dataLoader.ro = {
	'Error loading the file': 'Eroare la incarcarea fisierului',
	'Error parsing JSON file': 'Eroarea la parsarea fisierului JSON',
	'Unsupported data format': 'Formatul de date nu este suportat',
	'Loading data...': 'Se incarca...'
};
AmCharts.translations['export']['ro'] = {
	'fallback.save.text': 'CTRL + C pentru a copia datele in clipboard',
	'fallback.save.image': 'Click Dreapta -> Descarca imagine... pentru a salva imaginea.',
	'capturing.delayed.menu.label': '{{duration}}',
	'capturing.delayed.menu.title': 'Click pentru anulare',
	'menu.label.print': 'Printează',
	'menu.label.undo': 'Revers la modificare',
	'menu.label.redo': 'Revino la modificare',
	'menu.label.cancel': 'Anulează',
	'menu.label.save.image': 'Descarcă ...',
	'menu.label.save.data': 'Salvează ...',
	'menu.label.draw': 'Adnoteaza...',
	'menu.label.draw.change': 'Schimbă ...',
	'menu.label.draw.add': 'Adaugă ...',
	'menu.label.draw.shapes': 'Forme ...',
	'menu.label.draw.colors': 'Culoari ...',
	'menu.label.draw.widths': 'Marimi ...',
	'menu.label.draw.opacities': 'Opacitate ...',
	'menu.label.draw.text': 'Text',
	'menu.label.draw.modes': 'Mod ...',
	'menu.label.draw.modes.pencil': 'Creion',
	'menu.label.draw.modes.line': 'Linie',
	'menu.label.draw.modes.arrow': 'Sageată',
	'label.saved.from': 'Salvat de la: '
};

var chartVars = {
	type: 'serial',
	theme: 'light',
	language: 'ro',
	marginTop: 10,
	marginLeft: 15,
	marginRight: 20,
	colors: [chartColors.chart1],
	dataDateFormat: 'YYYY-MM-DD',
	valueAxes: [ {
		id: 'v1',
		axisThickness: 2,
	} ],
	balloon: {
		borderThickness: 1,
		shadowAlpha: 0
	},
	graphs: [ {
		id: 'g1',
		fillAlphas: 0.5,
		valueField: 'value'
	} ],
	chartCursor: {
		valueLineEnabled: true,
		valueLineBalloonEnabled: true,
		cursorAlpha: 0,
		zoomable: false
	},
	categoryField: 'date',
	categoryAxis: {
		axisThickness: 2
	},
	export: {
		enabled: false
	},
	dataLoader: {
		format: 'json',
		url: null,
		showErrors: true,
		async: true,
		complete: function(c) {
			var chart = $(c.containerDiv).parent().attr('id').replace('chart', '');

			var todayDate = new Date().toISOString().split('T')[0];

			var todayValueHolder = $('.chart-'+chart+'-value-today');

			if(todayValueHolder.attr('data-date')) {
				todayDate = todayValueHolder.attr('data-date');
			}
			var valueToday = c.dataProvider.find(function(d) { return d.date === todayDate });

			if(valueToday) {
				todayValueHolder.closest('.chart-today-value').show();
				todayValueHolder.text(valueToday.value);
			} else {
				todayValueHolder.closest('.chart-today-value').hide();
			}
		}
	}
};

function toURLDate(date) {
	if(date instanceof Date) {
		date = date.toISOString();
	}
	return date.split('T')[0];
}

function dataUrl(currency, baseCurrency, startDate, endDate) {
	var result = homeUrl + '/json/range/' + currency;
	if(baseCurrency) {
		result += '/' + baseCurrency;
	}
	if(startDate && endDate) {
		result += '/'+toURLDate(startDate)+'/'+toURLDate(endDate);
	}
	return result;
}

function loadChart(chartId, currency, color, startDate, endDate, baseCurrency) {
	var opts = $.extend(true, {}, chartVars);

	var multipliers = {
		'HUF': 100,
		'JPY': 100,
		'KRW': 100
	};

	var multiplier = multipliers[currency] || 1;
	if(!baseCurrency) {
		baseCurrency = 'RON';
	}
	opts.colors = [color];
	opts.dataLoader.url = dataUrl(currency, baseCurrency, startDate, endDate);

	opts.addClassNames = true;
	opts.graphs[0].balloonText = '<div style="margin:5px; font-size:12px;">' + multiplier + ' ' + currency + ' = <b>[[value]]</b> ' + baseCurrency + '</div>';
	opts.graphs[0].classNameField = 'bulletClass';
	opts.graphs[0].bulletField = 'bullet';
	opts.graphs[0].labelText = '[[label]]';
	opts.graphs[0].labelPosition = 'right';
	opts.chartCursor = {
		categoryBalloonDateFormat: 'D MMMM YYYY',
		cursorPosition: 'mouse',
		cursorColor: '#000',
		color: '#fff'
	};
	opts.categoryAxis.parseDates = true;
	AmCharts.makeChart('chart' + chartId, opts);
}

function chartStock(chartId) {
	var chartContainer = $('#' + chartId);
	if(chartContainer.length > 0) {
		var dataSets = [];
		var defaultCurrency = chartContainer.attr('data-currency');
		var defaultCurrencyTitle = currencies[defaultCurrency];
		dataSets.push({
			title: defaultCurrencyTitle,
			currency: defaultCurrency,
			dataProvider: [],
			dataLoader: {},
			categoryField: 'date',
			fieldMappings: [{
				fromField: 'value',
				toField: 'value'
			}]
		});
		$.each(currencies, function(currency, currencyTitle) {
			if(currency !== defaultCurrency && currency !== baseCurrency) {
				dataSets.push({
					title: currencyTitle,
					currency: currency,
					dataProvider: [],
					dataLoader: {},
					categoryField: 'date',
					fieldMappings: [{
						fromField: 'value',
						toField: 'value'
					}]
				});
			}
		});
		dataSets[0].dataLoader.url = dataUrl(defaultCurrency);
		dataSets[0].dataLoader.format = 'json';
		dataSets[0].color = chartColors.chart1;

		var chart = AmCharts.makeChart(chartId, {
			type: 'stock',
			theme: 'light',
			language: 'ro',
			dataSets: dataSets,
			dataDateFormat: 'YYYY-MM-DD',
			chartScrollbarSettings: {
				graph: 'g1',
				position: 'bottom'
			},
			panels: [{
				showCategoryAxis: !0,
				title: 'Value',
				percentHeight: 70,
				stockGraphs: [{
					id: 'g1',
					valueField: 'value',
					comparable: !0,
					compareField: 'value',
					bullet: 'round',
					compareGraphBullet: 'round',
					fillAlphas: .5,
					compareGraphFillAlphas: .4,
					balloonText: '[[title]]: <strong>[[value]]</strong> ' + baseCurrency,
					compareGraphBalloonText: '[[title]]: <strong>[[value]]</strong> ' + baseCurrency
				}],
				stockLegend: {
					periodValueTextComparing: '[[percents.value.close]]%',
					periodValueTextRegular: '[[value.close]]'
				}
			}],
			categoryField: 'date',
			periodSelector: {
				position: 'left',
				fromText: 'Perioada:',
				toText: '',
				periodsText: 'Zoom:',
				periods: [{
					period: 'MM',
					count: 1,
					label: '1 lună'
				}, {
					period: 'MM',
					selected: !0,
					count: 3,
					label: '3 luni'
				}, {
					period: 'MM',
					count: 6,
					label: '6 luni'
				}, {
					period: 'YYYY',
					count: 1,
					label: '1 an'
				}, {
					period: 'YTD',
					label: 'An curent'
				}, {
					period: 'MAX',
					label: 'Tot'
				}]
			},
			chartCursorSettings: {
				valueBalloonsEnabled: !0,
				fullWidth: !0,
				cursorAlpha: .1,
				cursorColor: '#000',
				color: '#fff'
			},
			dataSetSelector: {
				position: 'left',
				width: 180,
				listHeight: 130,
				selectText: 'Valuta:',
				compareText: 'Compară cu:'
			}
		});
		chart.addListener('rendered', function(data) {
			function loadCurrencyData(data) {
				$.ajax({
					type: 'GET',
					url: dataUrl(data.dataSet.currency),
					cache: false,
					dataType: 'json',
					success: function(response) {
						data.dataSet.dataProvider = response;
						data.chart.validateData();
					}
				});
			}
			data.chart.dataSetSelector.addListener('dataSetCompared', loadCurrencyData);
			data.chart.dataSetSelector.addListener('dataSetSelected', loadCurrencyData);
		});
	}
}

function convertAmount(amount, fromVal, toVal, date) {
	var result = 0;

	// if(!currencies[fromVal] || !currencies[toVal]) {
	// 	return;
	// }

	if(date && window.cachedDateValues[date]) {
		fromVal = window.cachedDateValues[date][fromVal];
		toVal = window.cachedDateValues[date][toVal];
	}

	if(fromVal && toVal) {
		try {
			if(amount) {
				result = (fromVal * amount) / toVal;
			}
		} catch(error) {
			result = 0;
		}
	}

	if(typeof result !== 'number' || isNaN(result)) {
		result = 0;
	}
	result = Number(result);
	if(result.toPrecision) {
		result = result.toPrecision(5);
	}
	return result;
}

function amountWithVat(amount, vatPercentage) {
	var result = Number(amount) + (Number(amount) * 0.19);
	if(result.toPrecision) {
		result = result.toPrecision(5);
	}
	return result;
}

function loadCurrencyOn(date, onSuccess, loadingElement) {
	if(!window.cachedDateValues) {
		window.cachedDateValues = {};
	}
	date = toURLDate(date);
	if(date && window.cachedDateValues[date]) {
		onSuccess(window.cachedDateValues[date]);
	}
	if(loadingElement) {
		$(loadingElement).fadeIn('fast');
	}
	return $.ajax({
		type: 'GET',
		url: homeUrl + '/json/on/' + date,
		cache: false,
		dataType: 'json',
		success: function(response) {
			if(loadingElement) {
				$(loadingElement).fadeOut('fast');
			}
			if(response && response.published_on) {
				window.cachedDateValues[date] = response.values;
				onSuccess(response);
			}
		},

		fail: function() {
			if(loadingElement) {
				$(loadingElement).fadeOut('fast');
			}
		}
	});
}

function listInputSwitchSelectedValues(form) {
	form = form.closest('form');
	var from = form.find('#convert-from');
	var to = form.find('#convert-to');
	var fromVal = from.val();
	from.val(to.val()).change();
	to.val(fromVal).change();
}

(function($) {
	$(document).ready(function() {
		/* Date Picker */
		$('.input-group.date').datepicker({
			format: 'yyyy-mm-dd',
			language: 'ro',
			weekStart: 1,
			startDate: '2015-01-01',
			endDate: 'tomorrow',
			maxViewMode: 2,
			daysOfWeekDisabled: '0,6',
			todayHighlight: true,
			// orientation: 'bottom auto'
		});

		/* List Input */
		var oppositeList = { convert_from: 'convert-to', convert_to: 'convert-from' };
		$('.list-input input[type="hidden"]').on('change', function() {
			var field = $(this).closest('.list-input');
			var value = $(this).val();
			var valueIsSupported = currencies[value] || null;
			if(valueIsSupported) {
				var current = field.find('li[data-value="'+value+'"]');
				field.find('li.active').removeClass('active');
				current.addClass('active');
			}
		});
		$('.list-input li > a').on('click', function() {
			event.preventDefault();
			var field = $(this).closest('ul');
			var input = field.find('input[type="hidden"]');
			var value = $(this).closest('li[data-value]').attr('data-value');
			var valueIsSupported = currencies[value] || null;
			if(valueIsSupported) {
				var otherList = oppositeList[input.attr('id').replace('-', '_')];
				otherList = $('#'+otherList);

				if(otherList.val() === value) {
					var otherValue = field.find('li[data-value].active').attr('data-value');
					otherList.val(otherValue).change();
				}
				input.val(value).change();
			}
		});

		/* Charts */
		var today = new Date();
		var threeMonthsAgo = new Date(today);
		threeMonthsAgo.setDate(threeMonthsAgo.getDate() - 90);
		
		loadChart(1, 'EUR', chartColors.chart1, threeMonthsAgo, today);
		loadChart(2, 'USD', chartColors.chart2, threeMonthsAgo, today);
		loadChart(3, 'GBP', chartColors.chart3, threeMonthsAgo, today);

		if(window.akdGraph4) {
			var graph4 = window.akdGraph4;
			loadChart(4, graph4.currency, graph4.color, graph4.startDate || threeMonthsAgo, graph4.endDate || today, graph4.baseCurrency)
		}

		$('.currencies-dropdown .dropdown-menu li a').on('click', function(t) {
			var currency = $(this).attr('data-currency');
			var $main = $(this).closest('.currencies-dropdown');
			var chart = $main.attr('data-chart');
			if(currency && chart) {
				$('.chart-'+chart+'-currency').text(currency);
				loadChart(chart, currency, chartColors['chart'+chart], threeMonthsAgo, today);
			}
		});

		chartStock('chart-currency-evolution');


		/* Converters */
		var converterSelector = '.converter #amount, .converter #convert-from, .converter #convert-to, .converter #datepicker';
		var fastConverterSelector = '.fast-converter #amount, .fast-converter #convert-from, .fast-converter #convert-to';
		$(converterSelector+', '+fastConverterSelector).on('change', function() {
			var form = $(this).closest('form');
 
			var date = form.find('#datepicker');
			var from = form.find('#convert-from');
			var to = form.find('#convert-to');
			var amount = form.find('input#amount');
			var withVat = form.find('#with-vat');

			var convertedAmount = 0;
			if(date.val()) {
				var loadingElement = form.find('.loading');
				if(!loadingElement.length) {
					form.append('<div class="loading"><i class="fa fa-spinner fa-spin"></i></div>');
					loadingElement = form.find('.loading');
				}
				loadCurrencyOn(date.val(), function(response) {
					convertedAmount = convertAmount(amount.val(), from.val(), to.val(), date.val());
					form.find('input#result').val(convertedAmount).change();
					withVat.text(amountWithVat(convertedAmount));
				}, loadingElement);
			} else {
				convertedAmount = convertAmount(amount.val(), from.val(), to.val(), null);
				form.find('input#result').val(convertedAmount).change();
				withVat.text(amountWithVat(convertedAmount));
			}
		});
		$('.fast-converter #switch, .converter #switch').click(function(event) {
			event.preventDefault();
			listInputSwitchSelectedValues($(this));
		});
	});
})(jQuery);


//# sourceMappingURL=app.js.map
