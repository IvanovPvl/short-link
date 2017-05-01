<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($app) {
    $app->post('link', 'LinkController@store');
});