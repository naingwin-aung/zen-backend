<?php

namespace App\Services\Admin;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function listing($limit = 10, $search = null)
    {
        $query = User::with(['country', 'dial']);

        if ($search) {
            $query = $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(first_name) LIKE ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(phone_number) LIKE ?', ['%'.strtolower($search).'%']);
            });
        }

        return $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();
    }

    public function find($id)
    {
        $user = User::with(['country', 'dial'])->find($id);

        if (! $user) {
            throw new Exception('User not found.');
        }

        return $user;
    }

    /**
     * Build the prefilled payload used to create a copy of an existing user.
     */
    public function clone($id): array
    {
        $user = $this->find($id);

        return [
            'clone_from' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'title' => $user->title,
            'email' => null,
            'country_id' => $user->country_id,
            'dial_id' => $user->dial_id,
            'phone_number' => $user->phone_number,
            'country' => $user->country,
            'dial' => $user->dial,
        ];
    }

    public function create(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::create($data);

        return $user->load(['country', 'dial']);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);

        if (! $user) {
            throw new Exception('User not found.');
        }

        if (isset($data['password']) && ! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user->load(['country', 'dial']);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (! $user) {
            throw new Exception('User not found.');
        }

        $user->delete();

        return true;
    }
}
