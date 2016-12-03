@extends('layouts.one-column')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Convertor Valutar</div>
		<div class="panel-body">
			<form class="converter">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="datepicker">Curs din data de:</label>
							<input type="text" name="date" value="{{previousWeekDay(date('Y-m-d'), 'Y-m-d')}}" class="form-control input-md datepicker" id="datepicker" />
						</div>
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
@endsection

@section('scripts')
<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip();
</script>
@endsection
