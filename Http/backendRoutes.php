<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/newsletter'], function (Router $router) {
    $router->bind('subscriber', function ($id) {
        return app('Modules\Newsletter\Repositories\SubscriberRepository')->find($id);
    });
    $router->get('subscribers', [
        'as' => 'admin.newsletter.subscriber.index',
        'uses' => 'SubscriberController@index',
        'middleware' => 'can:newsletter.subscribers.index'
    ]);
    $router->get('subscribers/create', [
        'as' => 'admin.newsletter.subscriber.create',
        'uses' => 'SubscriberController@create',
        'middleware' => 'can:newsletter.subscribers.create'
    ]);
    $router->post('subscribers', [
        'as' => 'admin.newsletter.subscriber.store',
        'uses' => 'SubscriberController@store',
        'middleware' => 'can:newsletter.subscribers.create'
    ]);
    $router->get('subscribers/{subscriber}/edit', [
        'as' => 'admin.newsletter.subscriber.edit',
        'uses' => 'SubscriberController@edit',
        'middleware' => 'can:newsletter.subscribers.edit'
    ]);
    $router->put('subscribers/{subscriber}', [
        'as' => 'admin.newsletter.subscriber.update',
        'uses' => 'SubscriberController@update',
        'middleware' => 'can:newsletter.subscribers.edit'
    ]);
    $router->delete('subscribers/{subscriber}', [
        'as' => 'admin.newsletter.subscriber.destroy',
        'uses' => 'SubscriberController@destroy',
        'middleware' => 'can:newsletter.subscribers.destroy'
    ]);
// append

});
