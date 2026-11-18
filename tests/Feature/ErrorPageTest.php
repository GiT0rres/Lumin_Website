<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ErrorPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_unknown_route_shows_lumin_404_page(): void
    {
        $this->get('/nao-existe')->assertNotFound()->assertSee('Página não encontrada')->assertSee('Voltar ao início');
    }

    public function test_forbidden_shows_lumin_403_page(): void
    {
        $this->actingAs(User::factory()->create())->get('/admin/recomendacoes')
            ->assertForbidden()->assertSee('Acesso restrito');
    }
}
