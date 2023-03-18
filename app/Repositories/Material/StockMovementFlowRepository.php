<?php

namespace App\Repositories\Material;

use App\Mail\NewStockMovementNotificationMail;
use App\Models\Material\Material;
use App\Models\Material\StockMovementFlow;
use App\Models\User\User;
use App\Repositories\AbstractRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class StockMovementFlowRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(StockMovementFlow::class);
    }

    public function getAllMovements(array $request = [])
    {
        if (isset($request['date_start']) && isset($request['date_end'])) {
            $startDate = Carbon::parse($request['date_start']);
            $endDate = Carbon::parse($request['date_end']);

            if ($startDate->greaterThan($endDate)) {
                throw new \Exception('Data inicial não pode ser maior à data final.');
            }
        }

        return $this->getModel()::
        join('materials', 'materials.id', '=', 'stock_movement_flows.material_id')
            ->join('users', 'users.id', '=', 'stock_movement_flows.collaborator_id')
            ->join('offices', 'offices.id', '=', 'users.office_id')
            ->select(
                'stock_movement_flows.id',
                'stock_movement_flows.quantity',
                'stock_movement_flows.date',
                'stock_movement_flows.type',
                'materials.name as material_name',
                'users.name as collaborator_name',
                'offices.name as office_name',
                'users.is_active as collaborator_is_active'
            )
            ->when(isset($request['type']), function ($query) use ($request) {
                $query->where('type', $request['type']);
            })
            ->when(isset($request['date_start'], $request['date_end']), function ($query) use ($request) {
                $query->whereBetween('date', [$request['date_start'], $request['date_end']]);
            })
            ->when(isset($request['date_start']) && !isset($request['date_end']), function ($query) use ($request) {
                $query->where('date', '>=', $request['date_start']);
            })
            ->when(isset($request['date_end']) && !isset($request['date_start']), function ($query) use ($request) {
                $query->where('date', '<=', $request['date_end']);
            })
            ->when(isset($request['material_id']), function ($query) use ($request) {
                $query->where('material_id', $request['material_id']);
            })
            ->when(isset($request['collaborator_id']), function ($query) use ($request) {
                $query->where('collaborator_id', $request['collaborator_id']);
            })
            ->get();
    }


    public function addNewMovementRegister(array $data): void
    {
        $material = Material::find($data['material_id']);

        if ($data['type'] == 'out' && $data['quantity'] > $material->quantity) {
            throw new \Exception('Quantidade insuficiente em estoque');
        }

        if ($data['type'] == 'out') {
            $material->quantity -= $data['quantity'];
        } else {
            $material->quantity += $data['quantity'];
        }
        $material->save();

        $this->create([
            'material_id' => $data['material_id'],
            'date' => $data['date'],
            'quantity' => $data['quantity'],
            'collaborator_id' => $data['collaborator_id'],
            'type' => $data['type'],
        ]);

        $materialName = Material::find($data['material_id'])->name;
        $collaboratorName = User::find($data['collaborator_id'])->name;

        $notificationData = [
            'material_name' => $materialName,
            'quantity' => $data['quantity'],
            'type' => $data['type'],
            'date' => $data['date'],
            'collaborator_name' => $collaboratorName,
        ];

        $notificationData['date'] = new Carbon($data['date']);

        Mail::to('marcelo_mmds@hotmail.com')->send(new NewStockMovementNotificationMail($notificationData));
    }
}
