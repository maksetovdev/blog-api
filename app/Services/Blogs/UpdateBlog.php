<?php

namespace App\Services\Blogs;

use App\Models\Blog;
use App\Services\BaseService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UpdateBlog extends BaseService
{
  public function rules()
  {
    return [];
  }
  public function execute($data,$id) 
  {
    $this->validate($data);
    
    if(isset($data['title']))
    {
      $blog = Blog::where('id',$id)->first();
      Blog::where('id',$id)->first()->update(['title' => $data['title']]);    
    }
    if(isset($data['description']))
    {
      $blog = Blog::where('id',$id)->first();
      Blog::where('id',$id)->first()->update(['description' => $data['description']]);    
    }
    if(isset($data['text']))
    {
      $blog = Blog::where('id',$id)->first();
      Blog::where('id',$id)->first()->update(['text' => $data['text']]);    
    }
    if(isset($data['img_path']))
    {
      $blog = Blog::where('id',$id)->first();
      $img_name = explode('\\',$blog['img_path']);
      $size = sizeof($img_name) - 1 ;

      Storage::delete("img-blog/" . $img_name[$size]);

      $path = Storage::putFileAs( 'img-blog', $data['img_path'], time().$data['img_path']->getClientOriginalName());
      $name = explode('/',$path)['1'];

      $img_path = storage_path('\app\public\img-blog\\').$name;
    
      Blog::where('id',$id)->first()->update(['img_path',$img_path]);

    }
    return Blog::where('id',$id)->first();
  }
}





