<?php

declare(strict_types=1);

return [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => (bool)getenv('API_DEBUG')
    ],

    Api\Http\Action\HomeAction::class => function () {
        return new Api\Http\Action\HomeAction();
    }
];