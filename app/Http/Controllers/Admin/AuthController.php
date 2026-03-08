<?php
namespace App\Http\Controllers\Admin;
use App\Exceptions\MyException;
use App\Http\Controllers\Controller;
use App\Services\Admin\AuthService;
use Exception;
use Illuminate\Http\Request;

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
            ['user' => $user, 'token' => $token] = $this->service->login($request->email, $request->password);

            return success(['user' => $user, 'token' => $token], 'Login successful.');
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
            auth()->user()->currentAccessToken()->delete();

            return success(message: 'Logged out successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}