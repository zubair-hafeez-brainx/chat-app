<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchUsers(Request $request)
    {
        $request->validate([
            "text" => "required|string"
        ]);
        $users = User::where('name', 'LIKE', '%' . $request->get('text') . '%')->orWhere('email', 'LIKE', '%' . $request->get('text') . '%')->get();

        return response()->json($users, 200);
    }
}
