<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Users\SignIn;
use App\Services\Users\SignUp;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try
        {
            [$user, $token] = app(SignUp::class)->execute($request->all());
            return response([
                'user' => $user,
                'token' => $token
            ]);
        }
        catch (ValidationException $errors)
        {
            return response([
                'erros' => $errors->validator->errors()->all()
            ]);
        }
        catch (ModelNotFoundException $mod_error)
        {
            return response([
                'status' => 'failed',
                'message' => 'User not found or password is incorrect'
            ]);
        }
    }

        public function store(Request $request)
    {
        try
        {
            [$user, $token] = app(SignIn::class)->execute($request->all());
            return response([
                'user' => $user,
                'token' => $token
            ]);
        }
        catch(ValidationException $error)
        {
            return response([
                'errors' => $error->validator->errors()->all()
            ]);
        }
    }

    public function show(User $user)
    {
        return Auth::user();
    }
    public function update(Request $request, User $user)
    {
        //
    }
    public function destroy(User $user)
    {
        //
    }
}
