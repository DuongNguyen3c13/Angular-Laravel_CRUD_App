<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateApiTest extends TestCase
{
    // Test it can update user's info
    public function test_it_can_update_user($name ="dummy name", $address="dummy address", $age="12")
    {
    	$request_array = [
	        'name' => $name,
	        'address' => $address,
	        'age' => $age,
    	];
        $response = $this->call('POST', 'api/users/66', $request_array);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('users', ['name' => "$name", 'address' => "$address", 'age' => "$age"]);
    }

    // Test it can update user's info
    // public function test_it_cannot_update_user_with_wrong_format_name($name ="dummy_name", $address="dummy address", $age="12")
    // {
    //     $request_array = [
    //         'name' => $name,
    //         'address' => $address,
    //         'age' => $age,
    //     ];
    //     $response = $this->call('POST', 'api/users/66', $request_array);
    //     $this->assertDatabaseMissing('users', ['name' => "$name", 'address' => "$address", 'age' => "$age"]);
    // }
}
