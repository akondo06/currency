@extends('layouts.one-column')

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="panel-wrapper">
				<h3>Grafic evolutie curs <span class="chart-1-currency">EUR</span> din ultimele 3 luni</h3>
				<div class="panel panel-default">
					<div class="panel-body no-padding chart-wrapper">
						@include('components.currencies-dropdown', ['chart' => 1])
						<div class="chart-container small" id="chart1"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel-wrapper">
				<h3>Grafic evolutie curs <span class="chart-2-currency">USD</span> din ultimele 3 luni</h3>
				<div class="panel panel-default">
					<div class="panel-body no-padding chart-wrapper">
						@include('components.currencies-dropdown', ['chart' => 2])
						<div class="chart-container small" id="chart2"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel-wrapper">
				<h3>Grafic evolutie curs <span class="chart-3-currency">GBP</span> din ultimele 3 luni</h3>
				<div class="panel panel-default">
					<div class="panel-body no-padding chart-wrapper">
						@include('components.currencies-dropdown', ['chart' => 3])
						<div class="chart-container small" id="chart3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			@include('components.aside')
		</div>
		<div class="col-md-9">
			<div class="panel-wrapper">
				<h3>Cursul BNR afisat in data de {{roDate($rates[0]->published_on, 'long')}}, raportat la {{$currency->title()}}</h3>
				<div class="panel panel-default panel-with-table-sm">
					<div class="panel-body">
						<form class="form-inline" method="post">
							@include('components.date-picker', ['id' => 'index_date', 'value' => $index_date, 'size' => 'sm', 'label' => 'Afiseaza curs BNR din data de:'])
							@include('components.currencies-select', ['id' => 'index_currency', 'selected' => $currency->currency, 'currencyAsValue' => true, 'size' => 'sm', 'label' => 'raportat la'])
							<div class="form-group">
								<input type="submit" name="display" value="update" class="btn btn-primary btn-sm">
							</div>
						</form>
					</div>
					@include('components.currencies-table', ['rates' => $rates, 'with_variation' => true])
				</div>
			</div>
		</div>
	</div>
@endsection
