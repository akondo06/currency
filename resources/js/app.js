(function($) {
	$(document).ready(function() {
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

			var convertedValue = 0;

			if(from && to) {
				try {
					var amount = form.find('input#amount').val();
					if(amount) {
						var currency_multiplier = from.val() * amount;
						convertedValue = currency_multiplier / to.val();
					}
				} catch(error) {
					convertedValue = 0;
				}
			}

			if(typeof convertedValue !== 'number' || isNaN(convertedValue)) {
				convertedValue = 0;
			}
			if(convertedValue.toPrecision) {
				convertedValue = convertedValue.toPrecision(5);
			}
			form.find('input#result').val(convertedValue).change();
		});
	});
})(jQuery);

AmCharts.translations.ro = {
	"monthNames": ["Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"],
	"shortMonthNames": ["Ian", "Feb", "Mar", "Apr", "Mai", "Iun", "Iul", "Aug", "Sep", "Oct", "Nov", "Dec"],
	"dayNames": ["Duminică", "Luni", "Marţi", "Miercuri", "Joi", "Vineri", "Sâmbătă"],
	"shortDayNames": ["Du", "Lu", "Ma", "Mi", "Jo", "Vi", "Sb"],
	"zoomOutText": "Arată tot"
};
AmCharts.translations.dataLoader.ro = {
	'Error loading the file': 'Eroare la incarcarea fisierului',
	'Error parsing JSON file': 'Eroarea la parsarea fisierului JSON',
	'Unsupported data format': 'Formatul de date nu este suportat',
	'Loading data...': 'Se incarca datele...'
};
AmCharts.translations['export']['ro'] = {
	"fallback.save.text": "CTRL + C pentru a copia datele in clipboard",
	"fallback.save.image": "Rightclick -> Descarca imagine... pentru a salva imaginea.",
	"capturing.delayed.menu.label": "{{duration}}",
	"capturing.delayed.menu.title": "Click pentru anulare",
	"menu.label.print": "Tipareste",
	"menu.label.undo": "Revers la modificare",
	"menu.label.redo": "Revino la modificare",
	"menu.label.cancel": "Anuleaza",
	"menu.label.save.image": "Descarca ...",
	"menu.label.save.data": "Salveaza ...",
	"menu.label.draw": "Adnoteaza...",
	"menu.label.draw.change": "Schimba ...",
	"menu.label.draw.add": "Adauga ...",
	"menu.label.draw.shapes": "Forma ...",
	"menu.label.draw.colors": "Culoare ...",
	"menu.label.draw.widths": "Marime ...",
	"menu.label.draw.opacities": "Opacitate ...",
	"menu.label.draw.text": "Text",
	"menu.label.draw.modes": "Mod ...",
	"menu.label.draw.modes.pencil": "Creion",
	"menu.label.draw.modes.line": "Linie",
	"menu.label.draw.modes.arrow": "Sageata",
	"label.saved.from": "Salvat de la: "
};

var chart_vars = {
	type: 'serial',
	theme: 'light',
	language: 'ro',
	marginTop: 10,
	marginLeft: 15,
	marginRight: 20,
	colors: ['#ff0000'],
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
			console.log('yep.. data e acolo ...');
		}
	}
};

var chartColors = {
	chart1: '#c1c106',
	chart2: '#ff0000'
};

function toURLDate(date) {
	if(date instanceof Date) {
		date = date.toISOString();
	}
	return date.split('T')[0];
}

function loadChart(chartId, currency, color, startDate, endDate, baseCurrency) {
	var opts = $.extend(true, {}, chart_vars);

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
	opts.dataLoader.url = homeUrl + '/json/'+currency+'/'+baseCurrency+'/'+toURLDate(startDate)+'/'+toURLDate(endDate);

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

// function setChartDataSet(chart, dataset_url) {
// 	AmCharts.loadFile(dataset_url, {}, function(data) {
// 		chart.dataProvider = AmCharts.parseJSON(data);
// 		chart.validateData();
// 	});
// }

(function($) {
	$(document).ready(function() {
		var today = new Date();
		var threeMonthsAgo = new Date(today);
		threeMonthsAgo.setDate(threeMonthsAgo.getDate() - 90);
		
		loadChart(1, 'EUR', chartColors.chart1, threeMonthsAgo, today);
		loadChart(2, 'USD', chartColors.chart2, threeMonthsAgo, today);

		$('.currencies-dropdown .dropdown-menu li a').on('click', function(t) {
			var currency = $(this).attr('data-currency');
			var $main = $(this).closest('.currencies-dropdown');
			var chart = $main.attr('data-chart');
			if(currency && chart) {
				$('.chart-'+chart+'-currency').text(currency);
				loadChart(chart, currency, chartColors['chart'+chart], threeMonthsAgo, today);
			}
		});
	});
})(jQuery);
