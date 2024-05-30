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

    'account_tree' => [
        AccountTreeTypeEnum::ASSETS->value => 'الأصول',
        AccountTreeTypeEnum::STATIC_ASSETS->value => 'الأصول الثابتة',
        AccountTreeTypeEnum::CURRENT_ASSETS->value => 'الأصول الحالية',
        AccountTreeTypeEnum::CLIENTS->value => 'العملاء',
    ],
];
