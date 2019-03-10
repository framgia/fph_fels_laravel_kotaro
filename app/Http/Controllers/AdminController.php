<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function categoriesView($pageNumber)
    {
        $pageNumber < 0 ? $pageNumber = 1 : '';
        $categories = app(Category::class)->orderBy('updated_at', 'desc')->skip(10 * ($pageNumber - 1))->take(10)->get();
        return view('/admin/categories', compact('categories', 'pageNumber'));
    }

    public function categoryEdit($categoryId)
    {
        $category = app(Category::class)::find($categoryId);
        return view('/admin/categoryEdit', compact('category'));
    }

    public function categoryRestore($categoryId, Request $request)
    {
        $request->validate([
            'title' => 'required | max:50',
            'description' => 'required',
        ]);
        app(Category::class)::find($categoryId)->fill($request->all())->update();
        return $this->categoriesView(1);
    }

    public function categoryDestroy($categoryId)
    {
        $category = app(Category::class)::find($categoryId);
        return view('/admin/categoryDelete', compact('category'));
    }

    public function categoryDelete($categoryId)
    {
        app(Category::class)::find($categoryId)->delete();
        return $this->categoriesView(1);
    }
}
