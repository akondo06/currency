@extends('layouts.one-column')

@section('content')
	<div class="panel-wrapper">
		<h3>Convertor Rapid</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<form class="converter">
					<div class="row">
						<div class="col-sm-4">
							@include('components.date-picker', ['id' => 'datepicker', 'value' => previousWeekDay($latestDate, 'Y-m-d'), 'size' => 'md', 'label' => 'Curs din data de:'])
							<div class="form-group amount">
								<label for="amount">Suma:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-money"></i></div>
									<input type="text" id="amount" class="form-control input-md">
								</div>
							</div>
							<div class="form-group result">
								<label for="result">Rezultat:</label>
								<div class="input-group">
									<input type="text" id="result" class="form-control input-md" value="0" />
									<div class="input-group-addon">
										Cu TVA: <span id="with-vat">0</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							@include('components.currencies-list', ['id' => 'convert-from', 'selected' => 'EUR', 'label' => 'Transforma din:', 'switch' => true])
						</div>
						<div class="col-sm-4">
							@include('components.currencies-list', ['id' => 'convert-to', 'selected' => 'RON', 'label' => 'In:'])
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip();
</script>
@endsection
