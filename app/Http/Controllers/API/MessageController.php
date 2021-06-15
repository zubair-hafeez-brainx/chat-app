<?php

namespace App\Http\Controllers\API;

use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $authUser = auth()->user();
        $request->validate([
            'to' => 'required|integer|exists:users,id',
            'message' => 'required'
        ]);

        $user = User::find($request->get('to'));

        $message = $user->messagable()->create(['from' => $authUser->id,
            'message' => $request->get('message')]);

        $data['user'] = $authUser->only(['id', 'name', 'email']);
        $data['message'] = $message->message;
        $data['messagable_id'] = $user->id;

        event(new MessageCreated('user', $data));

        return response()->json($message->only([
            'id', 'messagable_id', 'from', 'message'
        ]), 201);
    }
}
