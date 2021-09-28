<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);

        $getAllUser = new UserCollection(User::with('profile:id,email,city,province,phone')->paginate($limit));

        return response()->json($getAllUser, Response::HTTP_OK);
    }

    public function store(UserRequest $request)
    {
        $saveUser = new User();

        $saveUser->username = $request->username;
        $saveUser->password = $request->password;
        $saveUser->profile_id = $request->profile_id;

        $saveUser->save();

        $response = [
            'message' => 'success created transaction',
            'status' => Response::HTTP_CREATED,
            'data' => $saveUser
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }
}
