<?php

return array(

    /**
     * Set our Sandbox and Live credentials
     */
    'client_id'=>'Ae44YNLq0u6Gc4kRHBupZkKwssHsk8WXfOhV3wAft9QCNs0Lgy5SxpWg2y1SG7rz2TBSJb4E8fFFtkMO',
    'secret'=>'EA-a0taF_6pVNgOQwdo_71zbDWDIn5MabbG5NtASMeJIkhAyR1kfvc4_n45y1o6o2tIkqklE6eQ-wper',
//    'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
//    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET', ''),
//    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''),
//    'live_secret' => env('PAYPAL_LIVE_SECRET', ''),
//
//    'live_plan_id' => env('PAYPAL_LIVE_PLAN_ID', ''),
//    'sandbox_plan_id' => env('PAYPAL_SANDBOX_PLAN_ID', ''),


    /**
     * SDK configuration settings
     */
    'settings' => array(

        /**
         * Payment Mode
         *
         * Available options are 'sandbox' or 'live'
         */
//        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'mode'=>'sandbox',
        // Specify the max connection attempt (3000 = 3 seconds)
        'http.ConnectionTimeOut' => 3000,

        // Specify whether or not we want to store logs
        'log.LogEnabled' => true,

        // Specigy the location for our paypal logs
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Log Level
         *
         * Available options: 'DEBUG', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the DEBUG level and decreases
         * as you proceed towards ERROR. WARN or ERROR would be a
         * recommended option for live environments.
         *
         */
        'log.LogLevel' => 'DEBUG'
    ),
);
