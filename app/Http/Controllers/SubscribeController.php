<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $currentUser = Auth::user();
        $targetUserId = $request->user_id;

        if ($currentUser->id == $targetUserId) {
            return response()->json([
                'success' => false,
                'message' => 'Нельзя подписаться на самого себя'
            ], 400);
        }

        $existingSubscription = Subscribe::where('user_id', $currentUser->id)
            ->where('subscribe_id', $targetUserId)
            ->first();

        if ($existingSubscription) {
            $existingSubscription->delete();
            $isSubscribed = false;
            $message = 'Вы отписались от пользователя';
        } else {
            Subscribe::create([
                'user_id' => $currentUser->id,
                'subscribe_id' => $targetUserId
            ]);
            $isSubscribed = true;
            $message = 'Вы подписались на пользователя';
        }

        $targetUser = User::find($targetUserId);
        $subscribersCount = $targetUser->subscribersCount();

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_subscribed' => $isSubscribed,
            'subscribers_count' => $subscribersCount
        ]);
    }
}