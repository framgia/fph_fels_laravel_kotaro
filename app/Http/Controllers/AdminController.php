<?php

namespace App\Http\Controllers;

use App\Category;
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
}
