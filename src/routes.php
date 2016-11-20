<?php

// Routes
$app->map(['GET', 'POST'], '/', '\App\\Controllers\\Home:index')->setName('index');
$app->get('/json/{currency}/{base_currency}/{start_date}/{end_date}', '\App\\Controllers\\ChartData:index')->setName('chartData');
$app->get('/{name}', '\App\\Controllers\\Home:page')->setName('page');
