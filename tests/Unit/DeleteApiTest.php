<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteApiTest extends TestCase
{
    // Test it can delete user with id
    public function test_it_can_delete_user()
    {
        $id = "215";
        $response = $this->call('GET', "api/users/$id");
        $this->assertDatabaseHas('users', ['id' => "$id"]);
        $response = $this->call('GET', "api/users/destroy/$id");
        $this->assertDatabaseMissing('users', ['id' => "$id"]);
    }
}
