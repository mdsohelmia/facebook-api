<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegistaionController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'avatar' => 'required'
        ]);

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $file_name = uniqid('avatar__', true).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatar'), $file_name);
            $url = asset('uploads/avatar/'.$file_name);

            $user = User::create([
                'name' => $request->input('first_name').' '.$request->input('last_name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'isActive' => true,
                'password' => bcrypt($request->input('password')),
                'avatar' => $url
            ]);
        }
        return response()->json([
            'data' => $user,
            'messages' => 'User has been successfully create.'
        ], 201);
    }
}
