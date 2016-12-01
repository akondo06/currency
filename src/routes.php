<?php

// Routes
$app->map(['GET', 'POST'], '/', '\App\\Controllers\\Home:index')->setName('index');
$app->get('/json/{currency}[/{base_currency}/{start_date}/{end_date}]', '\App\\Controllers\\ChartData:index')->setName('chartData');
$app->get('/evolutie-curs', '\App\\Controllers\\Home:evolution')->setName('currency-evolution');
$app->get('/convertor-valutar', '\App\\Controllers\\Home:convertor')->setName('currency-converter');
$app->get('/{name}', '\App\\Controllers\\Home:page')->setName('page');
