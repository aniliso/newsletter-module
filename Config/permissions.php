<?php

return [
    'newsletter.subscribers' => [
        'index' => 'newsletter::subscribers.list resource',
        'create' => 'newsletter::subscribers.create resource',
        'edit' => 'newsletter::subscribers.edit resource',
        'destroy' => 'newsletter::subscribers.destroy resource',
    ],
    'api.newsletter' => [
        'subscribe' => 'newsletter::subscribers.create resource',
    ]
];
