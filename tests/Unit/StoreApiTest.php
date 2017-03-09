<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreApiTest extends TestCase
{
	// Test it can store new user
    public function test_it_can_store_new_user($name ="dummy name", $address="dummy address", $age="12")
    {
    	$request_array = [
	        'name' => $name,
	        'address' => $address,
	        'age' => $age,
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
    public function test_it_returns_false_if_too_long_input_for_name(
    	// 101 characters
    	$name ="abcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdef", 
    	$address="dummy address", $age="12")
    {
    	$request_array = [
        'name' => $name,
        'address' => $address,
        'age' => $age,
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
    public function test_it_returns_false_if_wrong_format_input_for_name(
    	$name ="wrong_dummy_name", $address="dummy address", $age="12")
    {
    	$request_array = [
        'name' => $name,
        'address' => $address,
        'age' => $age,
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
    public function test_it_returns_false_if_blank_input_for_name($name ="", $address="dummy address", $age="12")
    {
    	$request_array = [
        'name' => $name,
        'address' => $address,
        'age' => $age,
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
    public function test_it_returns_false_if_wrong_input_format_for_address(
    	$name ="dummy name", $address="dummy_address", $age="12")
    {
    	$request_array = [
        'name' => $name,
        'address' => $address,
        'age' => $age,
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
    public function test_it_returns_false_if_blank_input_for_address($name ="dummy name", $address="", $age="12")
    {
    	$request_array = [
        'name' => $name,
        'address' => $address,
        'age' => $age,
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
