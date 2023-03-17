<?php

namespace App\Repositories\Office;

use App\Models\Office\Office;
use App\Repositories\AbstractRepository;

class OfficeRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Office::class);
    }

    public function officeUpdate(int $id, $data): void
    {
        $this->getQuery()
            ->where('id', $id)
            ->update($data);
    }

    public function officeDelete(int $id): void
    {
        $this->getQuery()
            ->where('id', $id)
            ->delete();
    }
}
