<?php

$app->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($app) {
    $app->get('stat/{short}', 'StatController@show');
    $app->post('link', 'LinkController@store');
});