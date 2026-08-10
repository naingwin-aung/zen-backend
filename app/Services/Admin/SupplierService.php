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

    /**
     * Build the prefilled payload used to create a copy of an existing supplier.
     *
     * @return array{clone_from: int, name: string, email: null, profile: ?string}
     */
    public function clone($id): array
    {
        $supplier = $this->find($id);

        return [
            'clone_from' => $supplier->id,
            'name' => $supplier->name,
            'email' => null,
            'profile' => $supplier->profile,
        ];
    }

    public function create($name, $email, $password, $profile = null, $cloneFrom = null)
    {
        $image = null;
        if ($profile) {
            $image = storeImage('suppliers', $profile);
        } elseif ($cloneFrom) {
            $source = Supplier::find($cloneFrom);
            $image = $source ? copyStoredImage('suppliers', $source->getRawOriginal('profile')) : null;
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
