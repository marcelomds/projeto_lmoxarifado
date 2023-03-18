<?php

namespace App\Http\Controllers;

use App\Exports\StockMovementsExport;
use App\Repositories\Material\MaterialRepository;
use App\Repositories\Material\StockMovementFlowRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    private $userRepository;
    private $stockMovementFlowRepository;
    private $materialRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository,
                                StockMovementFlowRepository $stockMovementFlowRepository,
                                MaterialRepository $materialRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->stockMovementFlowRepository = $stockMovementFlowRepository;
        $this->materialRepository = $materialRepository;
    }

    public function index(Request $request)
    {
        try {
            $collaborators = $this->userRepository->getAllActivesCollaborators();
            $materials = $this->materialRepository->getAllActivesMaterials();
            $stockMovements = $this->stockMovementFlowRepository->getAllMovements($request->all());
        } catch (\Exception $e) {
            alert()->error($e->getMessage());

            return redirect()
                ->back();
        }

        return view('home', compact('collaborators', 'materials', 'stockMovements'));
    }

    public function addNewMovementRegister(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->stockMovementFlowRepository->addNewMovementRegister($request->all());
        } catch (\Exception $e) {
            alert()->error('Erro ao Registrar', $e->getMessage());

            return redirect()
                ->back();
        }

        toast('Registrado com Sucesso', 'success');

        return redirect()->route('home');
    }


    public function exportExcel()
    {
        try {
            if ($this->stockMovementFlowRepository->all()->count() == 0) {
                alert()->error('Erro ao Exportar', 'Não há registros para exportar');

                return redirect()
                    ->back();
            }
            return Excel::download(new StockMovementsExport(), 'movimentacao-almoxarifado.xlsx');

        } catch (\Exception $e) {
            alert()->error('Erro ao Exportar', $e->getMessage());

            return redirect()
                ->back();
        }
    }

}
