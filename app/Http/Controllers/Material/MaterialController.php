<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\CreateMaterialRequest;
use App\Http\Requests\Material\updateMaterialRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;
use App\Repositories\Material\MaterialRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class MaterialController extends Controller
{
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function index()
    {
        $materials = $this->materialRepository->paginate();
        return view('material.index', compact('materials'));
    }

    public function create()
    {
        return view('material.create');
    }

    public function store(CreateMaterialRequest $request)
    {
        try {
            $this->materialRepository->create($request->validated());
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        toast('Cadastro Realizado com Sucesso', 'success');

        return redirect()
            ->route('material.index');

    }

    public function edit(int $id)
    {
        $material = $this->materialRepository->find($id);
        return view('material.edit', compact('material'));
    }

    public function update(updateMaterialRequest $request, int $id)
    {
        try {
            $this->materialRepository->materialUpdate($id, $request->validated());
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        toast('Atualizado com Sucesso', 'success');

        return redirect()
            ->route('material.index');

    }

    public function destroy(int $id)
    {
        $this->materialRepository->materialDelete($id);

        toast('Removido com Sucesso', 'success');

        return redirect()->route('material.index');
    }
}
