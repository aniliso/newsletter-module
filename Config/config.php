<?php

return [
    'name'  => 'Newsletter',
    'rules' => [
        'email' => 'required|email',
        'name'  => 'required'
    ],
    'form_params'  => [
        'EMAIL'  => 'email',
        'ADINIZ' => 'name'
    ]
];
