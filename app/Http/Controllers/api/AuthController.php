<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function login(Request $request) {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('beatShareToken')->plainTextToken; 
            $success['name'] =  $authUser->username;
   
            return $this->sendResponse($success, 'Votre authentification a été un succès!');
        } 
        else{ 
            return $this->sendError([], ['error'=> "Connexion non autorisée!"]);
        } 
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['uuid'] = Str::uuid();
        $user = User::create($inputs);
   
        return $this->sendResponse([], 'Votre compte a été créer avec succès!');
    }
}
