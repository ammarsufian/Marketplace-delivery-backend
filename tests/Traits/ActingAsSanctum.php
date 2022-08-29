<?php


namespace Tests\Traits;


use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\Sanctum;

trait ActingAsSanctum
{

    public function actingAs(Authenticatable $user, $guard = NULL)
    {
        Sanctum::actingAs(
            $user,
            ['*']
        );

        return $this;
    }

}
