<?php

namespace App\Repositories\Material;

use App\Constants\Status\StatusConst;
use App\Models\Company\Employee;
use App\Models\Material\Material;
use App\Repositories\AbstractRepository;

class MaterialRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Material::class);
    }

    public function materialUpdate(int $id, $data): void
    {
        $this->getQuery()
            ->where('id', $id)
            ->update($data);
    }

    public function materialDelete(int $id): void
    {
        $this->getQuery()
            ->where('id', $id)
            ->delete();
    }

    public function updateStatus(int $id)
    {
        $material = $this->find($id);
        if ($material->is_active == 1) {
            $material->update(['is_active' => false]);
        } else {
            $material->update(['is_active' => true]);
        }
    }

    public function getAllActivesMaterials()
    {
        return $this->where('is_active', StatusConst::ACTIVE)
            ->get();
    }
}
