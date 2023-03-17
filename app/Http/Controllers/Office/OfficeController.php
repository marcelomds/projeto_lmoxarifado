<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\Office\CreateOfficeRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;
use App\Repositories\Office\OfficeRepository;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    private $officeRepository;
    public function __construct(OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    public function index()
    {
        $offices = $this->officeRepository->paginate();
        return view('office.index', compact('offices'));
    }

    public function create()
    {
        return view('office.create');
    }

    public function store(CreateOfficeRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->officeRepository->create($request->validated());
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        toast('Cadastro Realizado com Sucesso', 'success');

        return redirect()->route('office.index');
    }

    public function edit(int $id)
    {
        $office = $this->officeRepository->find($id);
        return view('office.edit', compact('office'));
    }

    public function update(UpdateOfficeRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->officeRepository->officeUpdate($id, $request->validated());
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        toast('Atualizado com Sucesso', 'success');

        return redirect()->route('office.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->officeRepository->officeDelete($id);

        toast('Removido com Sucesso', 'success');

        return redirect()->route('office.index');
    }
}
