<?php

namespace App\Services\Admin;

use App\Models\Supplier;
use Exception;
use Illuminate\Support\Facades\Storage;

class SupplierService
{
    public function listing($limit = 10, $search = null)
    {
        $query = Supplier::query();

        if ($search) {
            $query = $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search).'%']);
            });
        }

        return $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();
    }

    public function find($id)
    {
        $supplier = Supplier::find($id);

        if (! $supplier) {
            throw new Exception('Supplier not found.');
        }

        return $supplier;
    }

    public function create($name, $email, $password, $profile = null)
    {
        $image = null;
        if ($profile) {
            $image = storeImage('suppliers', $profile);
        }

        $supplier = Supplier::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'profile' => $image,
        ]);

        return $supplier;
    }

    public function update($id, $name, $email, $password = null, $profile = null)
    {
        $supplier = Supplier::find($id);

        if (! $supplier) {
            throw new Exception('Supplier not found.');
        }

        $image = $supplier->getRawOriginal('profile');
        if ($profile) {
            if ($image) {
                Storage::delete($image);
            }
            $image = storeImage('suppliers', $profile);
        }

        $supplier->update([
            'name' => $name,
            'email' => $email,
            'password' => $password ? bcrypt($password) : $supplier->password,
            'profile' => $image,
        ]);

        return $supplier;
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);

        if (! $supplier) {
            throw new Exception('Supplier not found.');
        }

        if ($supplier->profile) {
            $image = $supplier->getRawOriginal('profile');
            if ($image) {
                Storage::delete($image);
            }
        }

        $supplier->delete();

        return true;
    }
}
