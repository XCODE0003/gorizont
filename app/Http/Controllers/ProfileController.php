<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Articles;
use App\Models\Subscribe;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        if(!$user) {
            return redirect('/');
        }

        $articles = Articles::where('user_id', $id)->get();
        $subscribersCount = $user->subscribersCount();
        $subscriptionsCount = $user->subscriptionsCount();

        $isSubscribed = false;
        if (Auth::check()) {
            $isSubscribed = Subscribe::isSubscribed(Auth::user()->id, $id);
        }

        return Inertia::render('Profile', [
            'user' => $user,
            'articles' => $articles,
            'subscribersCount' => $subscribersCount,
            'subscriptionsCount' => $subscriptionsCount,
            'isSubscribed' => $isSubscribed
        ]);
    }
}
