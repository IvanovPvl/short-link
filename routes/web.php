<?php

$app->get('/{short}', 'RedirectController@get');

$app->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($app) {
    $app->post('link', 'LinkController@store');
});