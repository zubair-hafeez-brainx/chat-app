<?php

namespace App\Http\Controllers\API;

use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        \Log::debug($request->all());
        $authUser = auth()->user();
        $request->validate([
            'to' => 'required|integer|exists:users,id',
            'message' => 'sometimes',
            'file' => 'sometimes'
        ]);

        $user = User::find($request->get('to'));
        if ($request->hasFile('file')) {
            $url = $request->file('file')->store('chat-messages', 'public');
            $file = env('APP_URL') . '/' . Storage::url($url);
        }

        $message = $user->messagable()->create(['from' => $authUser->id,
            'message' => $request->get('message') ?? null,
            'file' => $file ?? null,
        ]);

        $data['user'] = $authUser->only(['id', 'name', 'email']);
        $data['message'] = $message->message;
        $data['file'] = $message->file;
        $data['messagable_id'] = $user->id;

        event(new MessageCreated('user', $data));

        return response()->json($message->only([
            'id', 'messagable_id', 'from', 'message', 'file'
        ]), 201);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function friendUsers()
    {
        $authUser = auth()->user();

        $myMessages = $authUser->messages()->distinct()->get('messagable_id');
        $userMessages = Message::where('messagable_id', $authUser->id)->distinct()->get('from');

        $messages = array_merge($myMessages->toArray(), $userMessages->toArray());
        foreach ($messages as $message) {
            $userIds[] = array_values($message)[0];
        }
        $users = User::whereIn('id', array_unique($userIds))->get();

        return response()->json($users, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function usersChat(Request $request)
    {
        $request->validate([
            "user_id" => "required|integer|exists:users,id"
        ]);
        $authUser = auth()->user();
        $user = $request->get('user_id');

        $myMessages = Message::where(['messagable_type' => 'User', 'from' => $authUser->id, 'messagable_id' => $user])->get()->toArray();
        $friendMessages = Message::where(['messagable_type' => 'User', 'from' => $user, 'messagable_id' => $authUser->id])->get()->toArray();
        $messages = array_merge($myMessages, $friendMessages);
        $collection = collect($messages)->sortByDesc('created_at')->values();

        return response()->json($collection, 200);
    }
}
