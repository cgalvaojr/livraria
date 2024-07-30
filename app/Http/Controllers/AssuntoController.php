<?php

namespace App\Http\Controllers;

use App\Http\Requests\Assunto as AssuntoRequest;
use App\Services\Livraria\Assunto as AssuntoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssuntoController extends Controller
{
    public function __construct(
        private readonly AssuntoService $assuntoService,
    ) {

    }

    public function index(): View
    {
        return view('livraria.assunto.index', ['assuntos' => $this->assuntoService->listar()]);
    }

    public function create(): View
    {
        return view('livraria.assunto.create');
    }

    public function store(AssuntoRequest $request): RedirectResponse
    {
        $this->assuntoService->salvar($request->all(['Descricao']));
        return redirect('assunto')->with('success', 'Assunto cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        try {
            $assunto = $this->assuntoService->listar($id);
            return view('livraria.assunto.edit', ['assunto' => $assunto]);
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function update(AssuntoRequest $request, string $id): RedirectResponse
    {
        $this->assuntoService->alterar($request->all(['Descricao']), $id);
        return redirect('assunto')->with('success', 'Assunto atualizado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->assuntoService->remover($id);
            return redirect('assunto')->with('success', 'Assunto removido com sucesso!');
        } catch (\Exception $e) {
            return redirect('assunto')->with('error', $e->getMessage());
        }
     }
}
