<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function create(CategoryRequest $req)
    {
        $category = new Category();
        $category->name = $req->name;
        $category->save();
 
        return redirect()->back()->with('success', 'Kategoria została dodana');
    }

    public function createForm()
    {
        return view('categoryCreate');
    }
}
