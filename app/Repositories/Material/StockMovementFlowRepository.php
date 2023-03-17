<?php

namespace App\Repositories\Material;

use App\Models\Material\Material;
use App\Models\Material\StockMovementFlow;
use App\Repositories\AbstractRepository;

class StockMovementFlowRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(StockMovementFlow::class);
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

    }
}
