<?php 

namespace App\Services;

use Illuminate\Support\Facades\Validator;

abstract class BaseService
{
  public function rules()
  {
    return [];
  }
  public function validate($data) : bool
  {
    Validator::make($data, $this->rules())->validate();
    return true;
  }
}