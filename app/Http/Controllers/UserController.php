<?php

namespace App\Http\Controllers;

use App\User;
use App\Lib\Helper;
use Illuminate\Http\Request;
use App\Traits\ResponseApi;

class UserController extends Controller
{
    use ResponseApi;

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

    public function userName(Request $request)
    {
        $id = $request->id;
        $result = Helper::getUserName($id);
        if (!$result) {
            return $this->error('User name not found');
        }

        return $this->success('User name', $result, 200);

    }
}
