<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        // redirect to default language
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/'.app()->getLocale().'/main');
        
    }
}
