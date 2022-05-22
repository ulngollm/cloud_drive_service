<?php

namespace App\Http\Services\YaDiskRequests;

interface StorageHttpRequest
{
    /**
     * Получить УРЛ запроса к API
     */
    public function getPath(): string;

    /**
     * Получить метод запроса к API
     */
    public function getMethod(): string;

    /**
     * Получить параметры запроса
     */
    public function getParams(): array;

}
