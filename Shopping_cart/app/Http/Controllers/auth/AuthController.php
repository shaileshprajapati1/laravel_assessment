<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthUser;
use Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AuthUser $user)
    {
        $rules = [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->withErrors($validator)->withInput($request->except('password'));
        } else {
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return true;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
