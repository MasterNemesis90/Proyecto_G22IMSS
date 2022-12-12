<?php

return [ 
    'client_id' => env('PAYPAL_CLIENT_ID',''),
    'secret' => env('PAYPAL_SECRET',''),

    'settings' => [
        'mode' => env('PAYPAL_MODE','sandbox'),
        // aqui se cambia por live
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName'=>storage_path() . '/logs/paypal.log',
        'log.LogLevel' =>'ERROR',
        'validation.level'=>'log' 
    ]
];


// $paypal->setConfig([
//     'mode'=>'live',
//     'http.ConnectionTimeOut'=>30,
//     'log.LogEnabled' => false,
//     'log.FileName'=>'',
//     'log.LogLevel' =>'FINE',
//     'validation.level'=>'log' ]);


    // return [ 
    //     'client_id' => env('PAYPAL_CLIENT_ID',''),
    //     'secret' => env('PAYPAL_SECRET',''),
    
    //     'settings' => [
    //         'mode' => env('PAYPAL_MODE','live'),
    //         // aqui se cambia por live
    //         'http.ConnectionTimeOut' => 30,
    //         'log.LogEnabled' => true,
    //         'log.FileName' => storage_path() . '/logs/paypal.log',
    //         'log.LogLevel' => 'ERROR'
    //     ]
    // ];