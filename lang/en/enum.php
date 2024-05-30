<?php

use App\Enums\AccountTreeTypeEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // Account Tree Type Enum
    'accont_tree' => [
        AccountTreeTypeEnum::ASSETS->value => 'Assets',
        AccountTreeTypeEnum::STATIC_ASSETS->value => 'Static Assets',
        AccountTreeTypeEnum::CURRENT_ASSETS->value => 'Current Assets',
        AccountTreeTypeEnum::CLIENTS->value => 'Clients',
    ],
];
