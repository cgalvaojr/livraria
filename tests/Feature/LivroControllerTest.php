<?php

namespace Tests\Feature;

use App\Models\Livro;
use Illuminate\Routing\Route;
use Tests\TestCase;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LivroControllerTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_listar_livroes(): void
    {
        $response = $this->get('/livro');
        $response->assertStatus(200);
    }
}
