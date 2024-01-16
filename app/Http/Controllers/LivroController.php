<?php

namespace App\Http\Controllers;

use App\Http\Requests\Livro as LivroRequest;
use App\Services\Livraria\Livro as LivroService;
use App\Services\Livraria\Assunto as AssuntoService;
use App\Services\Livraria\Autor as AutorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LivroController extends Controller
{
    public function __construct(
        private readonly LivroService $livroService,
        private readonly AssuntoService $assuntoService,
        private readonly AutorService $autorService,
    ) {

    }

    public function index(): View
    {
        return view('livraria.livro.index', ['livros' => $this->livroService->listar()]);
    }

    public function create(): View
    {
        $assuntos = $this->assuntoService->listar();
        $autores = $this->autorService->listar();
        return view('livraria.livro.create', ['assuntos' => $assuntos, 'autores' => $autores]);
    }

    public function store(LivroRequest $request): RedirectResponse
    {
        $this->livroService->salvar($request->all(['Titulo', 'Editora', 'Edicao', 'AnoPublicacao', 'Autor', 'Assunto', 'Valor']));
        return redirect('livro')->with('success', 'Livro cadastro com sucesso!');
    }

    public function edit(string $id)
    {
        try {
            $livro = $this->livroService->listar($id);
            $assuntos = $this->assuntoService->listar();
            $autores = $this->autorService->listar();
            return view('livraria.livro.edit', ['livro' => $livro, 'assuntos' => $assuntos, 'autores' => $autores]);
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function update(LivroRequest $request, string $id): RedirectResponse
    {
        $this->livroService->salvar($request->all(['Titulo', 'Editora', 'Edicao', 'AnoPublicacao', 'Autor', 'Assunto', 'Valor']), $id);
        return redirect('livro')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->livroService->remover($id);
        return redirect('livro')->with('success', 'Livro removido com sucesso!');
    }
}
