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
            $query->where('name', 'like', "%$search%");
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

        if (!$admin) {
            throw new Exception('Admin not found.');
        }

        return $admin;
    }

    public function create($name, $email, $password, $profile = null)
    {
        $image = null;
        if ($profile) {
            $image = storeImage('admins', $profile);
        }

        $admin = Admin::create([
            'name'     => $name,
            'email'    => $email,
            'password' => bcrypt($password),
            'profile'  => $image,
        ]);

        return $admin;
    }

    public function update($id, $name, $email, $password = null, $profile = null)
    {
        $admin = Admin::find($id);

        if (!$admin) {
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
            'name'     => $name,
            'email'    => $email,
            'password' => $password ? bcrypt($password) : $admin->password,
            'profile'  => $image,
        ]);

        return $admin;
    }

    public function delete($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
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