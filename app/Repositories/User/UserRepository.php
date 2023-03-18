<?php

namespace App\Repositories\User;

use App\Constants\Status\StatusConst;
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

    public function getAllActivesCollaborators()
    {
        return $this->with('office')
            ->where('id', '!=', auth()->user()->id)
            ->where('is_active', StatusConst::ACTIVE)
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

    public function updateStatus(int $id)
    {
        $user = $this->find($id);
        if ($user->is_active == 1) {
            $user->is_active = false;
        } else {
            $user->is_active = true;
        }
        $user->save();
    }
}
