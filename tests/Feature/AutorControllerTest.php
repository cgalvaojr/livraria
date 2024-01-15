<?php

namespace Tests\Feature;

use App\Models\Autor;
use Illuminate\Routing\Route;
use Tests\TestCase;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutorControllerTest extends TestCase
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

    public function test_listar_autores(): void
    {
        $response = $this->get('/autor');
        $response->assertStatus(200);
    }
    
    public function test_cadastro_autor_com_sucesso(): void
    {

        $payload = [
            'Nome' => 'Autor de teste',
        ];

        $response = $this->post('/autor', $payload);
        $response->assertRedirect('/autor');

        Autor::where('Nome', $payload['Nome']);
        $this->assertDatabaseHas('Autor', $payload);
    }

    public function test_cadastro_autor_erro(): void
    {
        $payload = [
            'Nome' => 'nome de autor contendo mais que 40 caracteres, o que deve retornar um erro pois podemos permitir apenas 40.',
        ];

        $this->post('/autor', $payload);
        Autor::where('Nome', $payload['Nome']);
        $this->assertDatabaseMissing('Autor', $payload);
    }

    public function test_alterar_autor_sucesso(): void
    {
        $payload = [
            'Nome' => 'Autor de teste 123',
        ];

        $autor = Autor::firstOrCreate($payload);
        $autor->Nome = 'Meu novo nome';

        $this->put("/autor/$autor->CodAu", $autor->toArray(), ["X-CSRF-Token" => csrf_token()]);
        $this->assertDatabaseHas('Autor', ['Nome' => $autor->Nome]);
    }

    public function test_alterar_autor_erro(): void
    {
        $payload = [
            'Nome' => 'Autor de teste',
        ];

        $autor = Autor::firstOrCreate($payload);
        $autor->Nome = 'nome de autor contendo mais que 40 caracteres, o que deve retornar um erro pois podemos permitir apenas 40.';

        $this->put("/autor/$autor->CodAu", $autor->toArray());
        $this->assertDatabaseMissing('Autor', ['Nome' => $autor->Nome]);
    }

    public function test_remover_autor_sucesso(): void
    {
        $payload = [
            'Nome' => 'Autor de teste',
        ];

        $autor = Autor::firstOrCreate($payload);

        $this->delete("/autor/$autor->CodAu");
        $this->assertDatabaseMissing('Autor', ['Nome' => $autor->Nome]);
    }
}
