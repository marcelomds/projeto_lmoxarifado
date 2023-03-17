<?php

namespace App\Repositories\Material;

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
}
