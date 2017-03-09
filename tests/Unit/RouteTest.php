<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
	// Test index page
    public function testIndexPage() {
    	$response = $this->get('/');
        $response->assertStatus(200);
    }
    // Test index api
    public function testIndexAPI() {
    	$response = $this->get('/api/users');
        $response->assertStatus(200);
    }
}
