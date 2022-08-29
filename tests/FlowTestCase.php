<?php


namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\WithApi;
use Tests\Traits\WithProviderApi;

class FlowTestCase extends TestCase
{
    use WithApi,
        DatabaseTransactions,
        WithFaker,
        WithProviderApi;
}
