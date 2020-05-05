<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Token
    |--------------------------------------------------------------------------
    |
    | R4nkt requires that you use an API token when communicating with its API.
    | Make one at the r4nkt API settings page: https://r4nkt.com/settings#/api
    |
    */

    'api_token' => env('R4NKT_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Game ID
    |--------------------------------------------------------------------------
    |
    | R4nkt also requires that you specify the game ID for each API call. Find
    | this at the game configuration settings: https://r4nkt.com/settings/games
    |
    */

    'game_id' => env('R4NKT_GAME_ID'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Signing Secret
    |--------------------------------------------------------------------------
    |
    | R4nkt will sign webhooks using a secret. You can find the secret used for
    | individual games at the game configuration settings:
    |  - https://r4nkt.com/settings/games
    |
    */

    'signing_secret' => env('R4NKT_SIGNING_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Jobs
    |--------------------------------------------------------------------------
    |
    | Here you can define the job that should be run when a certain webhook
    | hits your application.
    |
    | You can find a list of R4nkt webhook types here:
    |  - https://r4nkt.com/docs/webhooks/events
    |
    */

    'jobs' => [
        // 'badgeEarned' => \App\Jobs\R4nktWebhooks\HandleBadgeEarned::class,
        // ...
    ],

];
