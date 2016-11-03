<?php

// Routes
$app->get('/', '\App\\Controllers\\Home:index')->setName('index');
$app->get('/{name}', '\App\\Controllers\\Home:page')->setName('page');
