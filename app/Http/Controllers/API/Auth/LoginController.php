<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ]);
        $user = User::where('email', $request->get('email'))->first();

        if (!Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Credentials do not match.'],
            ]);
        }
        $data['token'] = $user->createToken('API')->plainTextToken;

        return response()->json($data, 200);
    }
}
