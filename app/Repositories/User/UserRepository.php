<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(User::class);
    }

    public function getAllCollaborators()
    {
        return $this->with('office')
            ->where('id', '!=', auth()->user()->id)
            ->orderByDesc('id')
            ->get();
    }

    public function userCreate(array $data)
    {
        return $this->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'office_id' => $data['office_id'] ?? null,
        ]);
    }

    public function userUpdate(int $id, $data): void
    {
        $this->getQuery()
            ->where('id', $id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'office_id' => $data['office_id'] ?? null,
            ]);
    }

    public function userDelete(int $id): void
    {
        $this->getQuery()
            ->where('id', $id)
            ->delete();
    }
}
