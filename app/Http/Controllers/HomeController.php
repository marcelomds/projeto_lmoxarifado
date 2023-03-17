<?php

namespace App\Http\Controllers;

use App\Exports\StockMovementsExport;
use App\Mail\NewStockMovementNotification;
use App\Repositories\Material\MaterialRepository;
use App\Repositories\Material\StockMovementFlowRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;


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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $collaborators = $this->userRepository->getAllCollaborators();
        $materials = $this->materialRepository->all();
        $stockMovements = $this->stockMovementFlowRepository->paginate();
        return view('home', compact('collaborators', 'materials', 'stockMovements'));
    }

    public function addNewMovementRegister(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->stockMovementFlowRepository->addNewMovementRegister($request->all());
//
//            Mail::to('seu-email@dominio.com')
//                ->send(new NewStockMovementNotification());
        } catch (\Exception $e) {

            alert()->error('Erro ao Registrar', $e->getMessage());

            return redirect()
                ->back();
        }

        toast('Registrado com Sucesso', 'success');

        return redirect()->route('home');
    }


    public function exportExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new StockMovementsExport(), 'movimentacao-almoxarifado.xlsx');
    }

}
