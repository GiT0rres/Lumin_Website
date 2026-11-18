<?php

namespace Tests\Feature;

use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecommendationTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_send_recommendation(): void
    {
        $this->post('/recomendacoes', ['name' => 'Ana', 'email' => 'ana@example.com', 'message' => 'Adicionar modo escuro'])
            ->assertRedirect(url('/').'#contato');

        $this->assertDatabaseHas('recommendations', ['email' => 'ana@example.com', 'status' => 'pendente']);
    }

    public function test_only_admins_can_access_panel(): void
    {
        $this->get('/admin/recomendacoes')->assertRedirect('/login');
        $this->actingAs(User::factory()->create())->get('/admin/recomendacoes')->assertForbidden();

        Recommendation::create(['name' => 'Ana', 'email' => 'ana@example.com', 'message' => 'Adicionar modo escuro']);
        $this->actingAs(User::factory()->admin()->create())->get('/admin/recomendacoes')
            ->assertOk()->assertSee('Adicionar modo escuro');
    }

    public function test_admin_can_review_recommendation(): void
    {
        $rec = Recommendation::create(['name' => 'Ana', 'email' => 'ana@example.com', 'message' => 'x']);
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)->patch("/admin/recomendacoes/{$rec->id}", ['status' => 'aprovada']);
        $this->assertSame('aprovada', $rec->fresh()->status);

        $this->actingAs($admin)->patch("/admin/recomendacoes/{$rec->id}", ['status' => 'hackeada'])->assertSessionHasErrors('status');
        $this->actingAs(User::factory()->create())->patch("/admin/recomendacoes/{$rec->id}", ['status' => 'rejeitada'])->assertForbidden();
    }
}
