<?php


use Ully\Cloudstorages\Models\TokenStorageCredentials;
use Ully\Cloudstorages\Services\YaDiskStorage;

return [
    'config' => [
        'routes' => [
            'prefix' => 'api/storages'
        ]
    ],
    'drivers' => [
        'ya_disk' => [
            'name' => 'Яндекс Диск', //название, которое будет отображаться пользователю
            'handler' => YaDiskStorage::class,
            'credentials_type' => TokenStorageCredentials::class,
            'base_url' => 'https://cloud-api.yandex.net/v1',
            'icon' => null
        ]
    ]
];
