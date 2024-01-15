<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

use App\Services\Livraria\Autor as AutorService;
use App\Http\Requests\Autor as AutorRequest;
use Illuminate\View\View;

class AutorController extends Controller
{
    public function __construct(
       private readonly AutorService $autorService,
    ) {

    }

    public function index(): View
    {
        return view('livraria.autor.index', ['autores' => $this->autorService->recuperar()]);
    }

    public function create(): View
    {
        return view('livraria.autor.create');
    }

    public function store(AutorRequest $request): RedirectResponse
    {
        $this->autorService->salvar($request->all(['Nome']));
        return redirect('autor');
    }

    public function edit(string $id)
    {
        try {
            $autor = $this->autorService->recuperar($id);
            return view('livraria.autor.edit', ['autor' => $autor]);
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function update(AutorRequest $request, string $id): RedirectResponse
    {
            $this->autorService->alterar($request->all(['Nome']), $id);
            return redirect('autor');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->autorService->remover($id);
        return redirect('autor');
    }
}
