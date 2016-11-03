<?php $__env->startSection('aside'); ?> 
	<div class="panel panel-default">
		<div class="panel-heading">Convertor Rapid</div>
		<div class="panel-body">
			<form>
			<p>Calculeaza conform <b>cursului valutar BNR</b> din <b>28 Octombrie 2016</b>:</p>

			<div class="form-group">
				<label for="convert-from">Transforma din:</label>
				<select name="convert-from" id="convert-from" class="form-control input-sm">
					<option label="RON (Leul romanesc)" value="22">RON (Leul romanesc)</option>
					<option label="EUR (Euro)" value="8" selected="selected">EUR (Euro)</option>
					<option label="USD (Dolar SUA)" value="19">USD (Dolar SUA)</option>
					<option label="CHF (Francul elvetian)" value="4">CHF (Francul elvetian)</option>
					<option label="GBP (Lira sterlina)" value="9">GBP (Lira sterlina)</option>
					<option label="BGN (Leva bulgareasca)" value="2">BGN (Leva bulgareasca)</option>
					<option label="JPY (100 Yeni japonezi)" value="11">JPY (100 Yeni japonezi)</option>
					<option label="XAU (Gramul de aur)" value="20">XAU (Gramul de aur)</option>
					<option label="MDL (Leul moldovenesc)" value="12">MDL (Leul moldovenesc)</option>
					<option label="HUF (100 Forinti maghiari)" value="10">HUF (100 Forinti maghiari)</option>
					<option label="AUD (Dolarul australian)" value="1">AUD (Dolarul australian)</option>
					<option label="CAD (Dolarul canadian)" value="3">CAD (Dolarul canadian)</option>
					<option label="CZK (Coroana ceheasca)" value="5">CZK (Coroana ceheasca)</option>
					<option label="DKK (Coroana daneza)" value="6">DKK (Coroana daneza)</option>
					<option label="EGP (Lira egipteana)" value="7">EGP (Lira egipteana)</option>
					<option label="NOK (Coroana norvegiana)" value="13">NOK (Coroana norvegiana)</option>
					<option label="PLN (Zlotul polonez)" value="14">PLN (Zlotul polonez)</option>
					<option label="RUB (Rubla ruseasca)" value="15">RUB (Rubla ruseasca)</option>
					<option label="SEK (Coroana suedeza)" value="16">SEK (Coroana suedeza)</option>
					<option label="TRY (Lira turceasca)" value="18">TRY (Lira turceasca)</option>
					<option label="ZAR (Randul sud-african)" value="23">ZAR (Randul sud-african)</option>
					<option label="BRL (Realul brazilian)" value="24">BRL (Realul brazilian)</option>
					<option label="CNY (Renminbi chinezesc)" value="25">CNY (Renminbi chinezesc)</option>
					<option label="INR (Rupia indiana)" value="26">INR (Rupia indiana)</option>
					<option label="KRW (100 Woni sud-coreeni)" value="27">KRW (100 Woni sud-coreeni)</option>
					<option label="MXN (Peso-ul mexican)" value="28">MXN (Peso-ul mexican)</option>
					<option label="NZD (Dolar neo-zeelandez)" value="29">NZD (Dolar neo-zeelandez)</option>
					<option label="RSD (Dinarul sarbesc)" value="30">RSD (Dinarul sarbesc)</option>
					<option label="UAH (Hryvna ucraineana)" value="31">UAH (Hryvna ucraineana)</option>
					<option label="AED (Dirhamul Emiratelor)" value="32">AED (Dirhamul Emiratelor)</option>
				</select>
			</div>
			<div class="form-group">
				<label for="convert-to">in:</label> <i class="fa fa-refresh" id="switch-conversion"></i>
				<select name="convert-to" id="convert-to" class="form-control input-sm">
					<option label="RON (Leul romanesc)" value="22" selected="selected">RON (Leul romanesc)</option>
					<option label="EUR (Euro)" value="8">EUR (Euro)</option>
					<option label="USD (Dolar SUA)" value="19">USD (Dolar SUA)</option>
					<option label="CHF (Francul elvetian)" value="4">CHF (Francul elvetian)</option>
					<option label="GBP (Lira sterlina)" value="9">GBP (Lira sterlina)</option>
					<option label="BGN (Leva bulgareasca)" value="2">BGN (Leva bulgareasca)</option>
					<option label="JPY (100 Yeni japonezi)" value="11">JPY (100 Yeni japonezi)</option>
					<option label="XAU (Gramul de aur)" value="20">XAU (Gramul de aur)</option>
					<option label="MDL (Leul moldovenesc)" value="12">MDL (Leul moldovenesc)</option>
					<option label="HUF (100 Forinti maghiari)" value="10">HUF (100 Forinti maghiari)</option>
					<option label="AUD (Dolarul australian)" value="1">AUD (Dolarul australian)</option>
					<option label="CAD (Dolarul canadian)" value="3">CAD (Dolarul canadian)</option>
					<option label="CZK (Coroana ceheasca)" value="5">CZK (Coroana ceheasca)</option>
					<option label="DKK (Coroana daneza)" value="6">DKK (Coroana daneza)</option>
					<option label="EGP (Lira egipteana)" value="7">EGP (Lira egipteana)</option>
					<option label="NOK (Coroana norvegiana)" value="13">NOK (Coroana norvegiana)</option>
					<option label="PLN (Zlotul polonez)" value="14">PLN (Zlotul polonez)</option>
					<option label="RUB (Rubla ruseasca)" value="15">RUB (Rubla ruseasca)</option>
					<option label="SEK (Coroana suedeza)" value="16">SEK (Coroana suedeza)</option>
					<option label="TRY (Lira turceasca)" value="18">TRY (Lira turceasca)</option>
					<option label="ZAR (Randul sud-african)" value="23">ZAR (Randul sud-african)</option>
					<option label="BRL (Realul brazilian)" value="24">BRL (Realul brazilian)</option>
					<option label="CNY (Renminbi chinezesc)" value="25">CNY (Renminbi chinezesc)</option>
					<option label="INR (Rupia indiana)" value="26">INR (Rupia indiana)</option>
					<option label="KRW (100 Woni sud-coreeni)" value="27">KRW (100 Woni sud-coreeni)</option>
					<option label="MXN (Peso-ul mexican)" value="28">MXN (Peso-ul mexican)</option>
					<option label="NZD (Dolar neo-zeelandez)" value="29">NZD (Dolar neo-zeelandez)</option>
					<option label="RSD (Dinarul sarbesc)" value="30">RSD (Dinarul sarbesc)</option>
					<option label="UAH (Hryvna ucraineana)" value="31">UAH (Hryvna ucraineana)</option>
					<option label="AED (Dirhamul Emiratelor)" value="32">AED (Dirhamul Emiratelor)</option>
				</select>
			</div>

			<div class="form-group amount">
				<label for="amount">Suma:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-money"></i></div>
					<input type="text" id="amount" class="form-control input-sm">
				</div>
				<i class="fa fa-share"></i>
			</div>

			<div class="form-group result">
				<label for="result">Rezultat:</label>
				<input type="text" id="result" class="form-control input-sm" value="0">
			</div>
			<div class="form-group result collapse" style="">
				<label for="result">Rezultat cu TVA 20%:</label>
				<input type="text" id="result-with-vat" class="form-control input-sm" value="0">
			</div>
			<div class="form-group result collapse" style="">
				<label for="result">Valoare TVA 20%:</label>
				<input type="text" id="vat" class="form-control input-sm" value="0">
			</div>
		</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			300x250 ad
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Stiri</div>
		<div class="panel-body">
			Ceva stiri aici ... poate?
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			facebook widget
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<?php echo $__env->yieldContent('aside'); ?>
			</div>
			<div class="col-md-9">
				<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>