<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreApiTest extends TestCase
{
	// Test it can store new user
    public function test_it_can_store_new_user()
    {
    	$request_array = [
	        'name' => "dummy name",
	        'address' => "dummy address",
	        'age' => "12",
    	];
        $response = $this->call('POST', 'api/users', $request_array);
        $data = json_decode($response ->getContent(), true);
        $this->assertEquals(200, $response->status());
        if ($data['status']) {
        	$this->assertTrue(true);
    	} else {
        	$this->assertTrue(false);
    	}
    }

	// Test it can returns false if name input is too long
    public function test_it_returns_false_if_too_long_input_for_name()
    {
    	$request_array = [
    	// 101 characters
        'name' => "abcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdef",
        'address' => "dummy address",
        'age' => "12",
    ];
        $response = $this->call('POST', 'api/users', $request_array);
        $data = json_decode($response ->getContent(), true);
        $this->assertEquals(302, $response->status());
        if ($data['status']==false) {
        	$this->assertTrue(true);
    	} else {
        	$this->assertTrue(false);
    	}
    }

	// Test it can returns false if name input format is wrong
    public function test_it_returns_false_if_invalid_input_for_name()
    {
    	$request_array = [
        'name' => "wrong_dummy_name",
        'address' => "dummy address",
        'age' => "12",
    ];
        $response = $this->call('POST', 'api/users', $request_array);
        $data = json_decode($response ->getContent(), true);
        $this->assertEquals(302, $response->status());
        if ($data['status']==false) {
        	$this->assertTrue(true);
    	} else {
        	$this->assertTrue(false);
    	}
    }

	// Test it can returns false if name input is blank
    public function test_it_returns_false_if_blank_input_for_name()
    {
    	$request_array = [
        'name' => "",
        'address' => "dummy address",
        'age' => "12",
    ];
        $response = $this->call('POST', 'api/users', $request_array);
        $data = json_decode($response ->getContent(), true);
        $this->assertEquals(302, $response->status());
        if ($data['status']==false) {
        	$this->assertTrue(true);
    	} else {
        	$this->assertTrue(false);
    	}
    }

	// Test it can returns false if address input format is wrong
    public function test_it_returns_false_if_invalid_input_for_address()
    {
    	$request_array = [
        'name' => "dummy name",
        'address' => "invalid_dummy_address",
        'age' => "12",
    ];
        $response = $this->call('POST', 'api/users', $request_array);
        $data = json_decode($response ->getContent(), true);
        $this->assertEquals(302, $response->status());
        if ($data['status']==false) {
        	$this->assertTrue(true);
    	} else {
        	$this->assertTrue(false);
    	}
    }

	// Test it can returns false if address input is blank
    public function test_it_returns_false_if_blank_input_for_address()
    {
    	$request_array = [
        'name' => "dummy name",
        'address' => "",
        'age' => "12",
    ];
        $response = $this->call('POST', 'api/users', $request_array);
        $data = json_decode($response ->getContent(), true);
        $this->assertEquals(302, $response->status());
        if ($data['status']==false) {
        	$this->assertTrue(true);
    	} else {
        	$this->assertTrue(false);
    	}
    }
}
