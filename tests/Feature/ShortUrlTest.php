<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    public function admin_cannot_create_short_url()
    {
        $admin = User::factory()->create([
            'role' => 'Admin',
            'company_id' => null, 
        ]);

        $response = $this->actingAs($admin)->post('/short-urls', [
            'original_url' => 'https://google.com'
        ]);

        $response->assertStatus(403);
    }

    public function short_url_is_not_publicly_accessible()
    {
        $response = $this->get('/s/abcdef');

        $response->assertRedirect('/login');
    }
}
