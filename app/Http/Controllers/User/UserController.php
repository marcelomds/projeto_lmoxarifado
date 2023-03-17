<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateCollaboratorRequest;
use App\Http\Requests\User\UpdateCollaboratorRequest;
use App\Repositories\Office\OfficeRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $officeRepository;
    public function __construct(UserRepository $userRepository, OfficeRepository $officeRepository)
    {
        $this->userRepository = $userRepository;
        $this->officeRepository = $officeRepository;
    }

    public function index()
    {
        $collaborators = $this->userRepository->getAllCollaborators();

        return view('collaborator.index', compact('collaborators'));
    }

    public function create()
    {
        $offices = $this->officeRepository->all();

        return view('collaborator.create', compact('offices'));
    }

    public function store(CreateCollaboratorRequest $request)
    {
        try {
            $this->userRepository->userCreate($request->validated());
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        toast('Cadastro Realizado com Sucesso', 'success');

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $collaborator = $this->userRepository->find($id);
        $offices = $this->officeRepository->all();

        return view('collaborator.edit', compact('collaborator', 'offices'));
    }

    public function update(UpdateCollaboratorRequest $request, int $id)
    {
        try {
            $this->userRepository->userUpdate($id, $request->validated());
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        toast('Atualizado com Sucesso', 'success');

        return redirect()->route('user.index');
    }

    public function destroy(int $id)
    {
        $this->userRepository->userDelete($id);

        toast('Removido com Sucesso', 'success');

        return redirect()->route('user.index');
    }
}
