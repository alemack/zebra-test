<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_tender()
    {
        $response = $this->postJson('/api/tenders', []);
        $response->assertUnauthorized();
    }

    public function test_authenticated_user_can_create_and_get_tender()
    {
        $user = User::factory()->create();

        $payload = [
            'external_code' => 123456,
            'number' => '12345-67',
            'status' => 'new',
            'name' => 'Test Tender',
            'updated_at' => now()->toDateTimeString(),
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/tenders', $payload);
        $response->assertCreated()->assertJsonFragment(['name' => 'Test Tender']);

        // Проверить получение тендера по id
        $tenderId = $response->json('id');
        $get = $this->getJson("/api/tenders/{$tenderId}");
        $get->assertOk()->assertJsonFragment(['name' => 'Test Tender']);
    }
}
