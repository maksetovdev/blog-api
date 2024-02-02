<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\BaseService;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\throwException;

class SignUp extends BaseService
{
  public function rules()
  {
    return [
      'email' => 'required|exists:users,email',
      'password' => 'required'
    ];
  }
  public function execute($data)
  {
    $this->validate($data);

    $user = User::where('email',$data['email'])->first();
    
    if(! $user or ! Hash::check($data['password'],$user['password']))
    {
      throw new ModelNotFoundException();
    }
    
      $token = $user->createToken('login')->plainTextToken; 

    return [$user, $token];
  }
}