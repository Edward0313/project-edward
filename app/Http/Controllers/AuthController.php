<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function signup(CreatUser $request)
    {
        //驗證
        $validated = $request->validated();
        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);
        //儲存
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request){
        //驗證
        $validatedDate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        //驗證通過後，取得使用者資料
        if(!Auth::attempt($validatedDate)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = $request->user();

        //通行證
        $tokenResult = $user->createToken('Access Token');
        $tokenResult->token->save();
        
        return response(['token' => $tokenResult->accessToken]);

    }

    public function logout(Request $request){
        //撤銷通行證
        $request->user()->token()->revoke();
        return response()->json([
            'message' => '成功登出'
        ]);
    }

    public function user(Request $request){
        //取得使用者資料
        return response(
            $request->user()
        );
    }
}
