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
}
