<?php

namespace Tests\Feature;

use App\Models\Assunto;
use Illuminate\Routing\Route;
use Tests\TestCase;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssuntoControllerTest extends TestCase
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

    public function test_listar_assuntoes(): void
    {
        $response = $this->get('/assunto');
        $response->assertStatus(200);
    }
    
    public function test_cadastro_assunto_com_sucesso(): void
    {

        $payload = [
            'Descricao' => 'Assunto de teste',
        ];

        $response = $this->post('/assunto', $payload);
        $response->assertRedirect('/assunto');

        Assunto::where('Descricao', $payload['Descricao']);
        $this->assertDatabaseHas('Assunto', $payload);
    }

    public function test_cadastro_assunto_erro(): void
    {
        $payload = [
            'Descricao' => 'descricao de assunto contendo mais que 40 caracteres, o que deve retornar um erro pois podemos permitir apenas 40.',
        ];

        $this->post('/assunto', $payload);
        Assunto::where('Descricao', $payload['Descricao']);
        $this->assertDatabaseMissing('Assunto', $payload);
    }

    public function test_alterar_assunto_sucesso(): void
    {
        $payload = [
            'Descricao' => 'Assunto de teste 123',
        ];

        $assunto = Assunto::firstOrCreate($payload);
        $assunto->Descricao = 'Meu novo descricao';

        $this->put("/assunto/$assunto->CodAs", $assunto->toArray(), ["X-CSRF-Token" => csrf_token()]);
        $this->assertDatabaseHas('Assunto', ['Descricao' => $assunto->Descricao]);
    }

    public function test_alterar_assunto_erro(): void
    {
        $payload = [
            'Descricao' => 'Assunto de teste',
        ];

        $assunto = Assunto::firstOrCreate($payload);
        $assunto->Descricao = 'descricao de assunto contendo mais que 40 caracteres, o que deve retornar um erro pois podemos permitir apenas 40.';

        $this->put("/assunto/$assunto->CodAs", $assunto->toArray());
        $this->assertDatabaseMissing('Assunto', ['Descricao' => $assunto->Descricao]);
    }

    public function test_remover_assunto_sucesso(): void
    {
        $payload = [
            'Descricao' => 'Assunto de teste',
        ];

        $assunto = Assunto::firstOrCreate($payload);

        $this->delete("/assunto/$assunto->CodAs");
        $this->assertDatabaseMissing('Assunto', ['Descricao' => $assunto->Descricao]);
    }
}
