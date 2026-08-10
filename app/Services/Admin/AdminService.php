<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    public function listing($limit = 10, $search = null)
    {
        $query = Admin::query();

        if ($search) {
            $query = $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search).'%']);
            });
        }

        $data = $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    public function find($id)
    {
        $admin = Admin::find($id);

        if (! $admin) {
            throw new Exception('Admin not found.');
        }

        return $admin;
    }

    /**
     * Build the prefilled payload used to create a copy of an existing admin.
     *
     * @return array{clone_from: int, name: string, email: null, profile: ?string}
     */
    public function clone($id): array
    {
        $admin = $this->find($id);

        return [
            'clone_from' => $admin->id,
            'name' => $admin->name,
            'email' => null,
            'profile' => $admin->profile,
        ];
    }

    public function create($name, $email, $password, $profile = null, $cloneFrom = null)
    {
        $image = null;
        if ($profile) {
            $image = storeImage('admins', $profile);
        } elseif ($cloneFrom) {
            $source = Admin::find($cloneFrom);
            $image = $source ? copyStoredImage('admins', $source->getRawOriginal('profile')) : null;
        }

        $admin = Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'profile' => $image,
        ]);

        return $admin;
    }

    public function update($id, $name, $email, $password = null, $profile = null)
    {
        $admin = Admin::find($id);

        if (! $admin) {
            throw new Exception('Admin not found.');
        }

        $image = $admin->getRawOriginal('profile');
        if ($profile) {
            if ($image) {
                Storage::delete($image);
            }
            $image = storeImage('admins', $profile);
        }

        $admin->update([
            'name' => $name,
            'email' => $email,
            'password' => $password ? bcrypt($password) : $admin->password,
            'profile' => $image,
        ]);

        return $admin;
    }

    public function delete($id)
    {
        $admin = Admin::find($id);

        if (! $admin) {
            throw new Exception('Admin not found.');
        }

        if ($admin->profile) {
            $image = $admin->getRawOriginal('profile');
            if ($image) {
                Storage::delete($image);
            }
        }

        $admin->delete();

        return true;
    }
}
