<?php

namespace App\Services\Users;

use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignIn extends BaseService
{
  public function rules()
  {
    return [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required'
    ];
  }
  public function execute($data) 
  {
    //dd($data);
    $this->validate($data);
//    dd($data);
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
    ]);
    $token = $user->createToken('user model',['user'])->plainTextToken;
    return [$user, $token];
  }
}





