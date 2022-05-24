<?php

namespace App\Http\Services\ExternalStorage\DTO;

use App\Models\User;
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

    public function forUser(User $user)
    {
        $this->user_id = $user->id;
        return $this;
    }
}
