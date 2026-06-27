<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;

class ItemApiTest extends TestCase 
{
    protected $user;
    protected $admin;
    protected $category;

    protected function setUp(): void 
    {
        parent::setUp();

        $this->category = Category::firstOrCreate(
            ['id' => 1],
            ['name' => 'Electronics']
        );

        $this->user = User::firstOrCreate(
            ['email' => 'user.test@example.com'],
            [
                'name' => 'User Test',
                'password' => bcrypt('password'),
            ]
        );
        $this->user->update(['role' => 'user']);

        $this->admin = User::firstOrCreate(
            ['email' => 'admin.test@example.com'],
            [
                'name' => 'Admin Test',
                'password' => bcrypt('password'),
            ]
        );
        $this->admin->update(['role' => 'admin']); 
    }
    public function test_guest_cannot_access_items()
    {
        $this->getJson('/api/v1/items')
            ->assertStatus(401); 
    }
    public function test_user_can_list_items()
    {
        $token = $this->user->createToken('api-token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/items')
            ->assertStatus(200)
            ->assertJsonStructure([
                'status', 
                'data', 
                'message'
            ]);
    }
    public function test_user_cannot_delete_item()
    {
        $item = Item::create([
            'category_id' => 1,
            'name' => 'Test Item Dummy',
            'quantity' => 5,
            'price' => 100000
        ]);
        $token = $this->user->createToken('api-token')->plainTextToken;
        $this->deleteJson("/api/v1/items/{$item->id}", [], [
            'Authorization' => 'Bearer ' . $token
        ])->assertStatus(403); 
    }
    public function test_admin_can_delete_item()
    {
        $item = Item::create([
            'category_id' => 1,
            'name' => 'Test Item Admin Dummy',
            'quantity' => 2,
            'price' => 200000
        ]);
        $token = $this->admin->createToken('api-token')->plainTextToken;

        $this->deleteJson("/api/v1/items/{$item->id}", [], [
            'Authorization' => 'Bearer ' . $token
        ])->assertStatus(204); 
    }
}

