<?php

namespace App\Services\Blogs;

use App\Models\Blog;
use App\Services\BaseService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StoreBlog extends BaseService
{
  public function rules()
  {
    return [
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'text' => 'required',
      'img_path' => 'required'
    ];
  }
  public function execute($data) 
  {
    $this->validate($data);
    
    $path = Storage::putFileAs( 'img-blog', $data['img_path'], time().$data['img_path']->getClientOriginalName());
    $name = explode('/',$path)['1'];
    
    $user_id = Auth::user()['id'];
    
    $img_path = storage_path('\app\public\img-blog\\').$name;
    
    return Blog::create([
      'user_id' => $user_id,
      'title' => $data['title'],
      'description' => $data['description'],
      'text' => $data['text'],
      'img_path' => $img_path,
    ]);

    
  }
}





