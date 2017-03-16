<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateApiTest extends TestCase
{
    protected function assertDatabaseMissingStatus($request_array) {
        $response = $this->call('POST', 'api/users/66', $request_array);
        $this->assertDatabaseMissing('users', 
            ['name' => $request_array['name'], 'address' => $request_array['address'], 'age' => $request_array['age']]);
    }

    // Test it can update user's info
    public function test_it_can_update_user()
    {
    	$request_array = [
	        'name' => "dummy name",
	        'address' => "dummy address",
	        'age' => "12",
    	];
        $response = $this->call('POST', 'api/users/66', $request_array);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('users', 
            ['name' => $request_array['name'], 'address' => $request_array['address'], 'age' => $request_array['age']]);
    }

    // // Test it cannot update with invalid name
    public function test_it_cannot_update_user_with_invalid_name()
    {
        $request_array = [
            'name' => "dummy_name",
            'address' => "dummy address",
            'age' => "12",
        ];
        $this->assertDatabaseMissingStatus($request_array);
    }

    //  // Test it cannot update with too long name
    public function test_it_cannot_update_user_with_too_long_name()
    {
        $request_array = [
            'name' => "abcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdef",
            'address' => "dummy address",
            'age' => "12",
        ];
        $this->assertDatabaseMissingStatus($request_array);
    }

    // // Test it cannot update with blank name field
    public function test_it_cannot_update_user_with_blank_name()
    {
        $request_array = [
            'name' => "",
            'address' => "dummy address",
            'age' => "12",
        ];
        $this->assertDatabaseMissingStatus($request_array);
    }

    // // Test it cannot update with invalid address field
    public function test_it_cannot_update_user_with_invalid_address()
    {
        $request_array = [
            'name' => "dummy name",
            'address' => "dummy_address",
            'age' => "12",
        ];
        $this->assertDatabaseMissingStatus($request_array);
    }

    // // Test it cannot update with blank address field
    public function test_it_cannot_update_user_with_blank_address()
    {
        $request_array = [
            'name' => "dummy name",
            'address' => "",
            'age' => "12",
        ];
        $this->assertDatabaseMissingStatus($request_array);
    }

    // // Test it cannot update with blank age field
    public function test_it_cannot_update_user_with_blank_age()
    {
        $request_array = [
            'name' => "dummy name",
            'address' => "dummy address",
            'age' => "",
        ];
        $this->assertDatabaseMissingStatus($request_array);
    }
}
