<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\HTTP\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function categories_view($page_number)
    {
        $category_model = new Category();
        $five_categories_data = $category_model->get_five_category_data($page_number);

        return view('/admin/categories', compact('five_categories_data', 'page_number'));
    }

    public function category_edit_view($category_id)
    {
        $category_model = new Category();
        $category_data = $category_model->category_data($category_id);

        return view('/admin/category_edit', compact('category_data'));
    }

    public function category_edit_store($category_id, Request $request)
    {
        $category_model = new Category();
        if (!$category_model->category_exists($category_id)) {
        } else {
            $request->validate([
                'title' => 'required', 'description' => 'required',
            ]);
            $category_model = new Category();
            $category_data = $category_model->category_data($category_id);
            $category_data->title = $request->title;
            $category_data->description = $request->description;
            $category_data->update();
        }
        return redirect('/admin/categories/1');
    }

    public function category_delete_view($category_id)
    {
        $category_model = new Category();
        $category_data = $category_model->category_data($category_id);

        return view('/admin/category_delete', compact('category_data'));
    }

    public function category_delete($category_id)
    {
        $category_model = new Category();
        $category_data = $category_model->category_data($category_id);
        $category_data->delete();
        return redirect('/admin/categories/1');
    }
}
