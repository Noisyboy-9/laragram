<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FollowingsController extends Controller
{
    /**
     * The user may follow given user
     *
     * @param User $user
     */
    public function store(User $user)
    {
        auth()->user()->follow($user);
    }

    /**
     * The user may accept another user request
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function update(User $user)
    {
        auth()->user()->accept($user);

        return back();
    }

    /**
     * Decline given users follow request
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        auth()->user()->decline($user);

        return back();
    }
}
