<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $subscriptions = Subscribe::where('user_id', $user->id)
            ->with('subscribedTo')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($subscription) {
                return [
                    'id' => $subscription->id,
                    'user' => [
                        'id' => $subscription->subscribedTo->id,
                        'name' => $subscription->subscribedTo->name,
                        'email' => $subscription->subscribedTo->email,
                        'avatar' => $subscription->subscribedTo->avatar,
                    ],
                    'created_at' => $subscription->created_at->format('d.m.Y'),
                ];
            });

        $subscribers = Subscribe::where('subscribe_id', $user->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($subscription) {
                return [
                    'id' => $subscription->id,
                    'user' => [
                        'id' => $subscription->user->id,
                        'name' => $subscription->user->name,
                        'email' => $subscription->user->email,
                        'avatar' => $subscription->user->avatar,
                    ],
                    'created_at' => $subscription->created_at->format('d.m.Y'),
                ];
            });

        return Inertia::render('Settings/Subscriptions', [
            'subscriptions' => $subscriptions,
            'subscribers' => $subscribers,
            'subscriptionsCount' => $subscriptions->count(),
            'subscribersCount' => $subscribers->count()
        ]);
    }
}