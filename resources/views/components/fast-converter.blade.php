<form class="fast-converter">
	<p>Calculeaza conform <b>cursului valutar BNR</b> din <b>{{roDate(previousWeekDay(date('Y-m-d'), 'd F Y'), 'long')}}</b>:</p>

	@include('components.currencies-select', ['id' => 'convert-from', 'selected' => 'EUR', 'label' => 'Transforma din:'])
	@include('components.currencies-select', ['id' => 'convert-to', 'selected' => 'RON', 'label' => 'in:', 'switch' => true])
	<div class="form-group amount">
		<label for="amount">Suma:</label>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-money"></i></div>
			<input type="text" id="amount" class="form-control input-sm">
		</div>
	</div>
	<div class="form-group result">
		<label for="result">Rezultat:</label>
		<input type="text" id="result" class="form-control input-sm" value="0">
	</div>
</form>
