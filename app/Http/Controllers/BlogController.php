<?php

namespace App\Http\Controllers;

use App\Services\Blogs\StoreBlog;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Blog;
use App\Services\Blogs\UpdateBlog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::all();
    }

    
    public function store(Request $request)
    {
        try
        {
            return app(StoreBlog::class)->execute($request->all());
        }
        catch(ValidationException $error)
        {
            return response([
            'errors' => $error->validator->errors()->all()
            ], 422);
        }
    }

    
    public function show(string $id)
    {
        return Blog::where('id',$id)->first();
    }

    
    public function update(Request $request, string $id)
    {
        try
        {
            return app(UpdateBlog::class)->execute($request->all(),$id);
        }
        catch(ValidationException $error)
        {
            return response([
            'errors' => $error->validator->errors()->all()
            ], 422);
        }
    }

    
    public function destroy(string $id)
    {
        $blog = Blog::where('id',$id)->first();
        $img_name = explode('\\',$blog['img_path']);
        $size = sizeof($img_name) - 1 ;
        Storage::delete("img-blog/" . $img_name[$size]);

        Blog::destroy($id);

        return true;
        
    }
}
