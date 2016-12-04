<?php

// Routes
$app->map(['GET', 'POST'], '/', '\App\\Controllers\\Home:index')->setName('index');
$app->get('/json/on[/{date}]', '\App\\Controllers\\ChartData:onDate')->setName('chartDataOn');
$app->get('/json/range/{currency}[/{base_currency}/{start_date}/{end_date}]', '\App\\Controllers\\ChartData:index')->setName('chartData');
$app->map(['GET', 'POST'], '/curs-{slug}', '\App\\Controllers\\Home:currency')->setName('currency');
$app->get('/evolutie-curs', '\App\\Controllers\\Home:evolution')->setName('currency-evolution');
$app->get('/convertor-valutar', '\App\\Controllers\\Home:convertor')->setName('currency-converter');
$app->get('/{name}', '\App\\Controllers\\Home:page')->setName('page');
