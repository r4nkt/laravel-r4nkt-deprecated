<?php

return [

    /*
    |--------------------------------------------------------------------------
    | R4nkt API Token
    |--------------------------------------------------------------------------
    |
    | R4nkt requires that you use an API token when communicating with its API.
    | Make one at the r4nkt API settings page: https://r4nkt.com/settings#/api
    |
    */

    'api_token' => env('R4NKT_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | R4nkt Game ID
    |--------------------------------------------------------------------------
    |
    | R4nkt also requires that you specify the game ID for each API call. Find
    | this at the game configuration settings: https://r4nkt.com/settings/games
    |
    */

    'game_id' => env('R4NKT_GAME_ID'),

];
