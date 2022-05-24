<?php

namespace App\Http\Services\ExternalStorage\DTO;

use Illuminate\Http\Request;


class NewStorage
{
    public function __construct(
        public int    $driver,
        public string $label,
        public array  $credentials,
        public ?int   $user_id = null
    )
    {
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            driver: $request->get('driver'),
            label: $request->get('label'),
            credentials: $request->get('credentials')
        );
    }

    public function userId(int $userId)
    {
        $this->user_id = $userId;
        return $this;
    }
}
