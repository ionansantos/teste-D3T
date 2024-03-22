<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Support\Facades\Validator;
use App\DataObjects\ResponseDataObject;
use App\Domain\ResponseTypeDomain;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                $user = Auth::user();

                $token = $user->createToken('auth_token')->plainTextToken;

                $this->ResponseDataObject->setData([
                    'user' => $user,
                    'token' => $token
                ]);

                return $this->ResponseDataObject->response();
            }

            $this->ResponseDataObject->setError(true);
            $this->ResponseDataObject->setTitle('Atenção!');
            $this->ResponseDataObject->setMessage('Usuário e/ou senha inválidos.');
            $this->ResponseDataObject->setType(ResponseTypeDomain::ERROR);
            $this->ResponseDataObject->setErrorCode(401);

            return $this->ResponseDataObject->response();
    }


    public function logout(Request $request)
    {
        try {
            Auth::guard('sanctum')->user()->tokens()->delete();

            $request->session()->invalidate();

            return $this->ResponseDataObject->response();
        } catch (\Exception $e) {

            return response()->json(['error' => 'Erro durante o logout'], 500);
        }
    }
}
