<?php

namespace App\Http\Controllers;

use App\Word;
use App\User;
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

    public function category_add_word_view($category_id)
    {
        return view('/admin/category_add_word', compact('category_id'));
    }

    public function category_add_word_store($category_id, Request $request)
    {
        $category_model = new Category();
        if (!$category_model->category_exists($category_id)) {
        } else {
            $request->validate([
                'word' => 'required', 'answer' => 'required',
                'choice1' => 'required', 'choice2' => 'required',
                'choice3' => 'required', 'choice4' => 'required',
            ]);
            $word_model = new Word();
            $word_model->store($category_id, $request);
        }

        return redirect('/admin/categories/1');
    }

    public function category_view_words($category_id, $page_number)
    {
        $word_model = new Word();
        $ten_words = $word_model->get_ten_words_data($category_id, $page_number);
        return view('/admin/category_view_words', compact('category_id', 'ten_words', 'page_number'));
    }

    public function category_edit_word($word_id)
    {
        $word_model = new Word();
        $word = $word_model->get_word_by_id($word_id);
        return view('/admin/category_edit_word', compact('word'));
    }

    public function category_restore_word($word_id, Request $request)
    {
        $request->validate([
            'word' => 'required', 'answer' => 'required',
            'choice1' => 'required', 'choice2' => 'required',
            'choice3' => 'required', 'choice4' => 'required',
        ]);
        $word_model = new Word();
        $category_id = $word_model->restore($word_id, $request);
        return redirect('/admin/category/view_word/' . $category_id . '/1');
    }

    public function category_view_delete_word($word_id)
    {
        $word_model = new Word();
        $word = $word_model->get_word_by_id($word_id);
        return view('/admin/category_delete_word', compact('word'));
    }

    public function category_delete_word($word_id)
    {
        $word = Word::where('id', $word_id)->first();
        $category_id = $word->category_id;
        $word->delete();

        return redirect('/admin/category/view_word/' . $category_id . '/1');
    }

    public function view_all_users($page_number)
    {
        $user_model = new User();
        $ten_users = $user_model->get_ten_users_data($page_number);
        return view('/admin/users', compact('ten_users'));
    }

    public function add_user()
    {
        return view('/admin/user_add');
    }

    public function store_user(Request $request)
    {
        $user_model = new User();
        $user_model = $user_model->store($request);

        return redirect('/admin/users/1');
    }

    public function view_edit_user($id)
    {
        $user = User::select('id', 'name', 'email')->find($id);

        return view('/admin/user_edit', compact('user'));
    }

    public function restore_user($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        return redirect('/admin/users/1');
    }

    public function view_destroy_user($id)
    {
        $user = User::select('id', 'name', 'email')->find($id);

        return view('/admin/user_delete', compact('user'));
    }

    public function destroy_user($id)
    {
        $user = User::select('id', 'name', 'email')->find($id);
        $user->delete();

        return redirect('/admin/users/1');
    }

    public function view_all_admins($page_number)
    {
        $user_model = new User();
        $ten_admins = $user_model->get_ten_admins_data($page_number);
        return view('/admin/admins', compact('ten_admins'));
    }

    public function add_admin()
    {
        return view('/admin/admin_add');
    }

    public function store_admin(Request $request)
    {
        $user_model = new User();
        $user_model = $user_model->admin_store($request);

        return redirect('/admin/admins/1');
    }
}