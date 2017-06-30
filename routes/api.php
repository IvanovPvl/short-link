<?php

$app->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($app) {
    $app->get('stat', 'StatController@index');
    $app->post('link', 'LinkController@store');
});