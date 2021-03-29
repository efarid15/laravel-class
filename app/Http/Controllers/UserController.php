<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDetails(Request $request)
    {
        $user_id = $request->user_id;

        $user = User::find($user_id);
        $response = [
            'code' => 200,
            'message' => 'User details',
            'result' => $user
        ];

        return response()->json($response);
    }

    public function users(Request $request)
    {
        $users = User::all();
        $response = [
            'code' => 200,
            'message' => 'User details',
            'result' => $users
        ];
        return response()->json($response);
    }
}
