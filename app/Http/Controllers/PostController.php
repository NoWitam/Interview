<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResouce;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function create(PostRequest $req)
    {
        $post = new Post();
        $post->save(); // zapisujemy teraz zeby program znal id postu
        $post = Post::find($post->id); // wyszukujemy zeby odpalil sie event update bo niestety event create tam nie pomoze z uwagi na to ze save() musi byc sync()
        $post->content = $req->content;
        $post->categories()->sync($req->categories);
        $post->save();

        return redirect()->back()->with('success', 'Post został dodany');
    }

    public function edit(PostRequest $req)
    {
        $post = Post::find($req->id);
        $post->content = $req->content;
        $post->save();
        $post->categories()->sync($req->categories);

        return redirect()->back()->with('success', 'Post został pomyślnie edytowany');

    }

    public function editForm($postId)
    {
        $categories = Category::all();
        $post = Post::with('categories')->find($postId);
        $myCategoriesId = [];
        foreach($post->categories as $category)
        {
            $myCategoriesId[] = $category->id;
        }

        return view('postCreate', [
            'categories' => $categories,
            'edit' => true,
            'postId' => $post->id,
            'postContent' => $post->content,
            'postCategoriesId' => $myCategoriesId
        ]);
    }

    public function createForm()
    {
        $categories = Category::all();
        return view('postCreate', [
            'categories' => $categories,
        ]);
    }

    public function show($categoryId = null) 
    {
        if($categoryId == null)
        {
            if(Cache::has('category_all'))
            {
                return Cache::get('category_all');
            }
            else
            {
                $posts = PostResouce::collection(Post::with('categories')->get());
                Cache::put('category_all', $posts);             
            }
        }
        else
        {
            if(Cache::has('category_'.$categoryId))
            {
                return Cache::get('category_'.$categoryId);
            }
            else
            {
                $posts = PostResouce::collection(
                    Category::with('posts')
                    ->find($categoryId)
                    ->posts
                );

                Cache::put('category_'.$categoryId, $posts);
            }
        }

        return $posts;
    }


}
