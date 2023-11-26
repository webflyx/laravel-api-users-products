<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_users_index(): void
    {
        $response = $this->get('/api/users');

        $response->assertOk();
    }
    
    public function test_users_show(): void
    {
        $response = $this->get('/api/users/1');

        $response->assertOk();
    }

    public function test_users_store(): void
    {
        $response = $this->post('/api/users', [
            'first_name' => 'My Name',
            'last_name' => 'My LastName',
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'My Name',
            'last_name' => 'My LastName',
        ]);

        $response->assertOk();
    }

    public function test_users_update(): void
    {
        $response = $this->put('/api/users/1', [
            'first_name' => 'My NameUpd',
            'last_name' => 'My LastNameUpd',
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'My NameUpd',
            'last_name' => 'My LastNameUpd',
        ]);

        $response->assertOk();
    }

    public function test_users_delete(): void
    {
        $response = $this->delete('/api/users/1');

        $response->assertStatus(204);
    }
}
