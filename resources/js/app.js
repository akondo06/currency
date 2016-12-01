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
		complete: function() {
			// console.log('yep.. data e acolo ...');
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
	var result = homeUrl + '/json/' + currency;
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

function convertValue(from, to, amount, date, fromVal, toVal) {
	var result = 0;

	if(date && !fromVal && !toVal && cachedDateValues[date]) {
		fromVal = cachedDateValues[date][from].value;
		toVal = cachedDateValues[date][to].value;
	}

	if(from && to) {
		try {
			if(amount) {
				var currency_multiplier = fromVal * amount;
				result = currency_multiplier / toVal;
			}
		} catch(error) {
			result = 0;
		}
	}

	if(typeof result !== 'number' || isNaN(result)) {
		result = 0;
	}
	if(result.toPrecision) {
		result = result.toPrecision(5);
	}
	return result;
}

(function($) {
	$(document).ready(function() {
		var today = new Date();
		var threeMonthsAgo = new Date(today);
		threeMonthsAgo.setDate(threeMonthsAgo.getDate() - 90);
		
		loadChart(1, 'EUR', chartColors.chart1, threeMonthsAgo, today);
		loadChart(2, 'USD', chartColors.chart2, threeMonthsAgo, today);
		loadChart(3, 'GBP', chartColors.chart3, threeMonthsAgo, today);

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


		/* Fast Converter */
		$('.fast-converter #switch').click(function(event) {
			event.preventDefault();
			var form = $(this).closest('.fast-converter');
			var from = form.find('select#convert-from');
			var to = form.find('select#convert-to');
			var fromVal = from.val();
			from.val(to.val()).change();
			to.val(fromVal).change();
		});
		$('.fast-converter #amount, .fast-converter #convert-from, .fast-converter #convert-to').on('change', function() {
			var form = $(this).closest('.fast-converter');

			var from = form.find('select#convert-from option:selected');
			var to = form.find('select#convert-to option:selected');

			var convertedValue = convertValue(from.attr('label').split(' ')[0], to.attr('label').split(' ')[0], form.find('input#amount').val(), null, from.val(), to.val());

			form.find('input#result').val(convertedValue).change();
		});
	});
})(jQuery);

