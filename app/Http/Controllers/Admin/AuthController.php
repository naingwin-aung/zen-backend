<?php
namespace App\Http\Controllers\Admin;
use App\Exceptions\MyException;
use App\Http\Controllers\Controller;
use App\Services\Admin\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            ['user' => $user] = $this->service->login($request->email, $request->password);

            if ($request->hasSession()) {
                $request->session()->regenerate();
            }

            return success(['user' => $user], 'Login successful.');
        } catch(MyException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }
         catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function user()
    {
        try {
            return success([
                'user' => auth()->user(),
            ], 'User retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::guard('admin')->logout();

            if (request()->hasSession()) {
                request()->session()->invalidate();
                request()->session()->regenerateToken();
            }

            return success(message: 'Logged out successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}