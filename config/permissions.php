<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    |
    | This value is the permissions used in the application. Changing the
    | value here affects database seeding and policy checks.
    | Avoid changing existing values!!!
    |
    */

    'role' => [
        'create' => 'CREATE_ROLE',
        'view' => 'VIEW_ROLE',
        'update' => 'UPDATE_ROLE',
        'assign' => 'ASSIGN_ROLE',
    ],
    'payment' => [
        'confirm' => 'CONFIRM_PAYMENT',
        'decline' => 'DECLINE_PAYMENT',
    ],
    'package' => [
        'create' => 'CREATE_PACKAGE',
        'update' => 'UPDATE_PACKAGE',
        'delete' => 'DELETE_PACKAGE',
    ],
    'withdrawal' => [
        'confirm' => 'CONFIRM_WITHDRAWAL',
        'decline' => 'DECLINE_WITHDRAWAL',
    ],
    'loan' => [
        'confirm' => 'CONFIRM_LOAN',
        'decline' => 'DECLINE_LOAN',
    ],
    'membership' => [
        'confirm' => 'CONFIRM_MEMBERSHIP',
        'decline' => 'DECLINE_MEMBERSHIP',
    ],
];
