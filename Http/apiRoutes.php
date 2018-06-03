<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'v1/newsletter'], function (Router $router) {
    $router->post('subscribe', [
        'as'         => 'api.newsletter.subscribe',
        'uses'       => 'PublicController@subscribe'
    ]);
});