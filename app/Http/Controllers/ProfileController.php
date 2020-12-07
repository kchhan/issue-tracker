<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user->id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::find($user->id);
        $projects = $user->projects()->get();
        $tickets = $user->tickets()->get();

        return view('profiles.show', compact('user', 'projects', 'tickets'));
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @param  int  $user->id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('updateProfile', $user);

        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the user's own profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user->id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('updateProfile', $user);

        $validator = Validator::make($request->all(), [
            'first_name' => ['string', 'required', 'min:3', 'max:255', 'alpha_dash'],
            'last_name' => ['string', 'required', 'min:3', 'max:255', 'alpha_dash'],
            'username' => [
                'string',
                'required',
                'min:3',
                'max:50',
                'alpha_dash',
                Rule::unique('users')->ignore($user),
            ],
            'email' => [
                'string',
                'email',
                'required',
                'min:3',
                'max:50',
                Rule::unique('users')->ignore($user),
            ],
            'avatar' => ['file'],
            'password' => ['string', 'min:8', 'max:255', 'confirmed', 'nullable']
        ]);

        if ($validator->fails()) {
            return redirect("/profiles/{$user->username}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = request(['first_name', 'last_name', 'username', 'email']);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        if (request('password')) {
            $attributes['password'] = request('password');
        }

        $user->update($attributes);

        return redirect("/profiles/$user->username");
    }
}
