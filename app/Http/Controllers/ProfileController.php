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
class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        if(!$user) {
            return redirect('/');
        }
        $articles = Articles::where('user_id', $id)->get();
        return Inertia::render('Profile', ['user' => $user, 'articles' => $articles]);
    }
}
